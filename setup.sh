#!/bin/bash

# LaraRadar - Quick Setup Script
# This script automates the initial setup of LaraRadar

set -e

echo "🚀 LaraRadar - Extended Threat Intelligence Platform"
echo "=================================================="
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if .env exists
if [ ! -f .env ]; then
    echo -e "${YELLOW}Creating .env file...${NC}"
    cp .env.example .env
    php artisan key:generate
    echo -e "${GREEN}✓ .env file created${NC}"
else
    echo -e "${GREEN}✓ .env file already exists${NC}"
fi

# Install Composer dependencies
echo -e "${YELLOW}Installing Composer dependencies...${NC}"
composer install --no-interaction
echo -e "${GREEN}✓ Composer dependencies installed${NC}"

# Install NPM dependencies
echo -e "${YELLOW}Installing NPM dependencies...${NC}"
npm install
echo -e "${GREEN}✓ NPM dependencies installed${NC}"

# Build frontend assets
echo -e "${YELLOW}Building frontend assets...${NC}"
npm run build
echo -e "${GREEN}✓ Frontend assets built${NC}"

# Publish vendor assets
echo -e "${YELLOW}Publishing vendor assets...${NC}"
php artisan vendor:publish --provider="Laravel\Horizon\HorizonServiceProvider" --tag=horizon-assets --force
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --force
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider" --force
echo -e "${GREEN}✓ Vendor assets published${NC}"

# Create storage symlink
echo -e "${YELLOW}Creating storage symlink...${NC}"
php artisan storage:link
echo -e "${GREEN}✓ Storage symlink created${NC}"

# Database setup
echo ""
echo -e "${YELLOW}Database Setup${NC}"
echo "=============="
read -p "Do you want to run migrations? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then
    echo -e "${YELLOW}Running migrations...${NC}"
    php artisan migrate --force
    echo -e "${GREEN}✓ Migrations completed${NC}"
    
    read -p "Do you want to seed the database with example data? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        echo -e "${YELLOW}Seeding database...${NC}"
        php artisan db:seed
        echo -e "${GREEN}✓ Database seeded${NC}"
    fi
fi

# Cache optimization
echo -e "${YELLOW}Optimizing application...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo -e "${GREEN}✓ Application optimized${NC}"

# Generate Swagger documentation
echo -e "${YELLOW}Generating API documentation...${NC}"
php artisan l5-swagger:generate
echo -e "${GREEN}✓ API documentation generated${NC}"

echo ""
echo -e "${GREEN}=================================================="
echo "✅ LaraRadar setup completed successfully!"
echo "==================================================${NC}"
echo ""
echo "📝 Next Steps:"
echo "  1. Configure your .env file with database credentials"
echo "  2. Run: php artisan serve"
echo "  3. Run: php artisan horizon (in another terminal)"
echo "  4. Visit: http://localhost:8000"
echo "  5. API Docs: http://localhost:8000/api/docs"
echo ""
echo "🔐 Default Credentials (after seeding):"
echo "  Superadmin: superadmin@lararadar.local / password"
echo "  Admin: admin@lararadar.local / password"
echo "  Analyst: analyst@lararadar.local / password"
echo "  Viewer: viewer@lararadar.local / password"
echo ""
echo "📚 Documentation:"
echo "  README.md - Installation & usage guide"
echo "  PROJECT_STATUS.md - Implementation progress"
echo "  docs/ - Comprehensive documentation"
echo ""
