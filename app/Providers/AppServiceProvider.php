<?php

namespace App\Providers;

use App\Repositories\AnswerCommentsRepository;
use App\Repositories\AnswerCommentsRepositoryInterface;
use App\Repositories\AnswersRepository;
use App\Repositories\AnswersRepositoryInterface;
use App\Repositories\GeneralItemMasterRepository;
use App\Repositories\GeneralItemMasterRepositoryInterface;
use App\Repositories\NotificationMessagesRepository;
use App\Repositories\NotificationMessagesRepositoryInterface;
use App\Repositories\QuestionsRepository;
use App\Repositories\QuestionsRepositoryInterface;
use App\Repositories\ScheduleRepository;
use App\Repositories\ScheduleRepositoryInterface;
use App\Repositories\SettingRepository;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\TentativeQuestionsRepository;
use App\Repositories\TentativeQuestionsRepositoryInterface;
use App\Services\AnswerCommentsService;
use App\Services\AnswerCommentsServiceInterface;
use App\Services\AnswersService;
use App\Services\AnswersServiceInterface;
use App\Services\MasterService;
use App\Services\MasterServiceInterface;
use App\Services\NotificationMessagesService;
use App\Services\NotificationMessagesServiceInterface;
use App\Services\QuestionsService;
use App\Services\QuestionsServiceInterface;
use App\Services\ScheduleService;
use App\Services\ScheduleServiceInterface;
use App\Services\SettingService;
use App\Services\SettingServiceInterface;
use App\Services\TentativeQuestionsService;
use App\Services\TentativeQuestionsServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // repository
        $this->app->bind(
            AnswerCommentsRepositoryInterface::class,
            AnswerCommentsRepository::class
        );
        $this->app->bind(
            AnswersRepositoryInterface::class,
            AnswersRepository::class
        );
        $this->app->bind(
            GeneralItemMasterRepositoryInterface::class,
            GeneralItemMasterRepository::class
        );
        $this->app->bind(
            NotificationMessagesRepositoryInterface::class,
            NotificationMessagesRepository::class
        );
        $this->app->bind(
            QuestionsRepositoryInterface::class,
            QuestionsRepository::class
        );
        $this->app->bind(
            ScheduleRepositoryInterface::class,
            ScheduleRepository::class
        );
        $this->app->bind(
            SettingRepositoryInterface::class,
            SettingRepository::class
        );
        $this->app->bind(
            TentativeQuestionsRepositoryInterface::class,
            TentativeQuestionsRepository::class
        );

        // service
        $this->app->bind(
            AnswerCommentsServiceInterface::class,
            AnswerCommentsService::class
        );
        $this->app->bind(
            AnswersServiceInterface::class,
            AnswersService::class
        );
        $this->app->bind(
            MasterServiceInterface::class,
            MasterService::class
        );
        $this->app->bind(
            NotificationMessagesServiceInterface::class,
            NotificationMessagesService::class
        );
        $this->app->bind(
            QuestionsServiceInterface::class,
            QuestionsService::class
        );
        $this->app->bind(
            ScheduleServiceInterface::class,
            ScheduleService::class
        );
        $this->app->bind(
            SettingServiceInterface::class,
            SettingService::class
        );
        $this->app->bind(
            TentativeQuestionsServiceInterface::class,
            TentativeQuestionsService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
