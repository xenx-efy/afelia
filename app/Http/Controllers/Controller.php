<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     description="Управление сущностями проекта трекера произведений.",
 *     version="1.0.0",
 *     title="Tracks api",
 *     @OA\Contact(
 *         email="xenx.efy@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="Composer",
 *     description="Управление сущностью композитора"
 * )
 *
 * @OA\Tag(
 *     name="Composition",
 *     description="Управление сущностью произведений"
 * )
 *
 * @OA\Tag(
 *     name="Tag",
 *     description="Управление сущностью тегов"
 * )
 *
 * @OA\Tag(
 *     name="User",
 *     description="Управление сущностью пользователя"
 * )
 *
 * @OA\Server(
 *     description="Main server",
 *     url="http://localhost/async"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
