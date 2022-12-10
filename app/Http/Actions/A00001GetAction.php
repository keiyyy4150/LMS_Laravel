<?php

/* 包括契約照会(買契約)のコントローラ
*
* @copyright 株式会社クイックサーブ All Rights Reserved
* @author Y.Utsumi <utsumi@91932.com>
*/

declare(strict_types=1);

namespace App\Http\Actions\S00;

use App\Http\Controllers\Controller;
use App\Http\Responders\S00\R00001GetResponder as Responder;
use App\Services\ViewInclusionContractListServiceInterface;
use App\Services\DepartmentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/* 包括契約照会(買契約)のGETコントローラ
*
* @copyright 株式会社クイックサーブ All Rights Reserved
* @author Y.Utsumi <utsumi@91932.com>
*/

class A00001GetAction extends Controller
{
    protected $Responder;
    /**
     * @var InclusionContractServiceInterface
     */
    private $inclusionContractService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param ViewInclusionContractListServiceInterface $inclusionContractService 包括契約照会(買契約)サービス
     * @param DepartmentServiceInterface $departmentService 部署マスタサービス
     */

    public function __construct(

        Responder                         $Responder,
        ViewInclusionContractListServiceInterface $inclusionContractService,
        DepartmentServiceInterface  $departmentService

    )
    {
        $this->Responder = $Responder;
        $this->inclusionContractService = $inclusionContractService;
        $this->departmentService = $departmentService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $search = $this->getSearchData($request);
        $per_page = $this->getPerPage($request);
        //  包括契約リスト
        $inclusionContracts = $this->inclusionContractService->searchBuy($search, $per_page);
        //  部署リスト
        $departments = $this->departmentService->getAllDepartments();

        return $this->Responder->response([
            'inclusionContracts' => $inclusionContracts,
            'search' => collect($search),
            'per_page' => $per_page,
            'departments' => $departments,
        ]);
    }
}
