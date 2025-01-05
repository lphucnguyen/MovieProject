<?php

namespace App\Application\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

class CommandBusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        // Actor
        Bus::map([
            \App\Application\Commands\Actor\GetActorCommand::class =>
            \App\Application\CommandHandlers\Actor\GetActorHandler::class,
            \App\Application\Commands\Actor\CreateActorCommand::class =>
            \App\Application\CommandHandlers\Actor\CreateActorHandler::class,
            \App\Application\Commands\Actor\UpdateActorCommand::class =>
            \App\Application\CommandHandlers\Actor\UpdateActorHandler::class,
            \App\Application\Commands\Actor\DeleteActorCommand::class =>
            \App\Application\CommandHandlers\Actor\DeleteActorHandler::class,
            \App\Application\Commands\Actor\GetActorsCommand::class =>
            \App\Application\CommandHandlers\Actor\GetActorsHandler::class,
            \App\Application\Commands\Actor\GetActorBySearchKeyCommand::class =>
            \App\Application\CommandHandlers\Actor\GetActorBySearchKeyHandler::class,
        ]);

        // Film
        Bus::map([
            \App\Application\Commands\Film\GetMovieWithReviewCommand::class =>
            \App\Application\CommandHandlers\Film\GetMovieWithReviewHandler::class,
            \App\Application\Commands\Film\GetMoviesByCategoryNameCommand::class =>
            \App\Application\CommandHandlers\Film\GetMoviesByCategoryNameHandler::class,
            \App\Application\Commands\Film\GetMoviesCommand::class =>
            \App\Application\CommandHandlers\Film\GetMoviesHandler::class,
            \App\Application\Commands\Film\AddToFavoriteCommand::class =>
            \App\Application\CommandHandlers\Film\AddToFavoriteHandler::class,
            \App\Application\Commands\Film\RemoveFromFavoriteCommand::class =>
            \App\Application\CommandHandlers\Film\RemoveFromFavoriteHandler::class,
            \App\Application\Commands\Film\DeleteMovieCommand::class =>
            \App\Application\CommandHandlers\Film\DeleteMovieHandler::class,
            \App\Application\Commands\Film\DeleteReviewCommand::class =>
            \App\Application\CommandHandlers\Film\DeleteReviewHandler::class,
            \App\Application\Commands\Film\RateMovieCommand::class =>
            \App\Application\CommandHandlers\Film\RateMovieHandler::class,
            \App\Application\Commands\Film\ReviewMovieCommand::class =>
            \App\Application\CommandHandlers\Film\ReviewMovieHandler::class,
            \App\Application\Commands\Film\UpdateMovieCommand::class =>
            \App\Application\CommandHandlers\Film\UpdateMovieHandler::class,
            \App\Application\Commands\Film\CreateMovieCommand::class =>
            \App\Application\CommandHandlers\Film\CreateMovieHandler::class,
        ]);

        // Category
        Bus::map([
            \App\Application\Commands\Category\GetCategoryCommand::class =>
            \App\Application\CommandHandlers\Category\GetCategoryHandler::class,
            \App\Application\Commands\Category\CreateCategoryCommand::class =>
            \App\Application\CommandHandlers\Category\CreateCategoryHandler::class,
            \App\Application\Commands\Category\UpdateCategoryCommand::class =>
            \App\Application\CommandHandlers\Category\UpdateCategoryHandler::class,
            \App\Application\Commands\Category\DeleteCategoryCommand::class =>
            \App\Application\CommandHandlers\Category\DeleteCategoryHandler::class,
        ]);

        // Admin
        Bus::map([
            \App\Application\Commands\Admin\GetAdminsCommand::class =>
            \App\Application\CommandHandlers\Admin\GetAdminsHandler::class,
            \App\Application\Commands\Admin\CreateAdminCommand::class =>
            \App\Application\CommandHandlers\Admin\CreateAdminHandler::class,
            \App\Application\Commands\Admin\DeleteAdminCommand::class =>
            \App\Application\CommandHandlers\Admin\DeleteAdminHandler::class,
            \App\Application\Commands\Admin\UpdateAdminCommand::class =>
            \App\Application\CommandHandlers\Admin\UpdateAdminHandler::class,
        ]);

        // Message
        Bus::map([
            \App\Application\Commands\Message\GetMessagesCommand::class =>
            \App\Application\CommandHandlers\Message\GetMessagesHandler::class,
            \App\Application\Commands\Message\DeleteMessageCommand::class =>
            \App\Application\CommandHandlers\Message\DeleteMessageHandler::class,
        ]);

        // Rating
        Bus::map([
            \App\Application\Commands\Rating\GetRatingsCommand::class =>
            \App\Application\CommandHandlers\Rating\GetRatingsHandler::class,
            \App\Application\Commands\Rating\DeleteRatingCommand::class =>
            \App\Application\CommandHandlers\Rating\DeleteRatingHandler::class,
        ]);

        // Review
        Bus::map([
            \App\Application\Commands\Review\GetReviewsCommand::class =>
            \App\Application\CommandHandlers\Review\GetReviewsHandler::class,
            \App\Application\Commands\Review\DeleteReviewCommand::class =>
            \App\Application\CommandHandlers\Review\DeleteReviewHandler::class,
        ]);

        // User
        Bus::map([
            \App\Application\Commands\User\GetUsersCommand::class =>
            \App\Application\CommandHandlers\User\GetUsersHandler::class,
            \App\Application\Commands\User\CreateUserCommand::class =>
            \App\Application\CommandHandlers\User\CreateUserHandler::class,
            \App\Application\Commands\User\DeleteUserCommand::class =>
            \App\Application\CommandHandlers\User\DeleteUserHandler::class,
            \App\Application\Commands\User\UpdateUserCommand::class =>
            \App\Application\CommandHandlers\User\UpdateUserHandler::class,
            \App\Application\Commands\User\ChangePasswordCommand::class =>
            \App\Application\CommandHandlers\User\ChangePasswordHandler::class,
            \App\Application\Commands\User\GetFavoritesCommand::class =>
            \App\Application\CommandHandlers\User\GetFavoritesHandler::class,
            \App\Application\Commands\User\GetRatingsCommand::class =>
            \App\Application\CommandHandlers\User\GetRatingsHandler::class,
            \App\Application\Commands\User\GetReviewsCommand::class =>
            \App\Application\CommandHandlers\User\GetReviewsHandler::class,
            \App\Application\Commands\User\GetTransactionsCommand::class =>
            \App\Application\CommandHandlers\User\GetTransactionsHandler::class,
            \App\Application\Commands\User\UpdateProfileCommand::class =>
            \App\Application\CommandHandlers\User\UpdateProfileHandler::class,
            \App\Application\Commands\Plan\GetPlansCommand::class =>
            \App\Application\CommandHandlers\Plan\GetPlansHandler::class,
        ]);

        // Dashboard
        Bus::map([
            \App\Application\Commands\Dashboard\GetDashboardCommand::class =>
            \App\Application\CommandHandlers\Dashboard\GetDashboardHandler::class,
        ]);

        // Home
        Bus::map([
            \App\Application\Commands\Home\SendMessageCommand::class =>
            \App\Application\CommandHandlers\Home\SendMessageHandler::class,
            \App\Application\Commands\Home\GetDataHomeCommand::class =>
            \App\Application\CommandHandlers\Home\GetDataHomeHandler::class,
        ]);
    }
}
