<?php

/* 包括契約登録のコントローラ
*
* @copyright 株式会社クイックサーブ All Rights Reserved
* @author Y.Utsumi <utsumi@91932.com>
*/

declare(strict_types=1);

namespace App\Http\Actions\S00;

use App\Http\Controllers\Controller;
use App\Http\Requests\S00\R00002PostRequest as Request;
use App\Http\Responders\S00\R00002PostResponder as Responder;
use App\Services\InclusionContractServiceInterface;
use App\Services\TentativeComprehensiveContractServiceInterface;
// use Illuminate\Http\Request;
//use Illuminate\Support\Carbon;

/* 包括契約登録のPOSTコントローラ
*
* @copyright 株式会社クイックサーブ All Rights Reserved
* @author Y.Utsumi <utsumi@91932.com>
*/

class A00002PostAction extends Controller
{
    protected $action = '00-00002';
    /**
     * @var Responder
     */
    protected $Responder;
    /**
     * @var InclusionContractServiceInterface
     */
    private $inclusionContractService;
    /**
     * @var TentativeComprehensiveContractServiceInterface
     */
    private $tentativecomprehensivecontractService;

    /**
     * コンストラクタ
     *
     * @param Responder $Responder レスポンダ
     * @param InclusionContractServiceInterface $inclusionContractService 包括契約登録サービス
     * @param TentativeComprehensiveContractServiceInterface $tentativecomprehensivecontractService 仮包括契約登録サービス
     */

    public function __construct(
        Responder                         $Responder,
        InclusionContractServiceInterface $inclusionContractService,
        TentativeComprehensiveContractServiceInterface $tentativecomprehensivecontractService
    )
    {
        $this->Responder = $Responder;
        $this->inclusionContractService = $inclusionContractService;
        $this->tentativecomprehensivecontractService = $tentativecomprehensivecontractService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->post();

        if (isset($data['save_mode']) && $data['save_mode'] == '1') {
          // 新規登録/変更（修正） パラメータ（仮包括契約No.）が設定されている場合、仮包括契約を破棄して登録
          $this->inclusionContractService->createinclusionContract($data);
        } else if (isset($data['save_mode']) && $data['save_mode'] == '2') {
          // 仮登録
          $this->tentativecomprehensivecontractService->createTentativeComprehensiveContract($data);
        } else if (isset($data['save_mode']) && $data['save_mode'] == '3' && !isset($data['tentative_inclusion_contract_number']) ) {
          // 取消:包括契約テーブル削除
          $this->inclusionContractService->deletelusionContract($data);
        } else if (isset($data['save_mode']) && $data['save_mode'] == '3' && !isset($data['inclusion_contract_number']) ) {
          // 取消:仮包括契約テーブル削除
          $this->tentativecomprehensivecontractService->deleteTentativeComprehensiveContract($data);
        }
        return $this->Responder->response($data);
    }
}
