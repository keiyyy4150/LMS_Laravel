<?php

declare(strict_types=1);

namespace App\Http\Responders\Students;

use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory AS ViewFactory;

class AnswerFormPostResponder
{
    protected $response;
    protected $view;

    public function __construct(Response $response, ViewFactory $view)
    {
        $this->response = $response;
        $this->view     = $view;
    }

    /**
     * @param array $data
     * @return Response
     */
    public function response($data)
    {
        return redirect()->route("question-detail.list", ['id' => $data['answerers_id'] ]);
    }
}
