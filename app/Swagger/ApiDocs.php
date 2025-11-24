<?php

namespace App\Swagger;

/**
 * Minimal OpenAPI PathItem to satisfy generator until controllers are annotated.
 *
 * @OA\Get(
 *     path="/health",
 *     summary="Health check",
 *     @OA\Response(response=200, description="OK")
 * )
 */
class ApiDocs
{
    // This class only contains OpenAPI annotations for L5-Swagger scanning.
}
