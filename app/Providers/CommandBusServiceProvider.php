<?php

namespace App\Providers;

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
            \App\Commands\Actor\GetActorCommand::class =>
            \App\CommandHandlers\Actor\GetActorHandler::class,
            \App\Commands\Actor\CreateActorCommand::class =>
            \App\CommandHandlers\Actor\CreateActorHandler::class,
            \App\Commands\Actor\UpdateActorCommand::class =>
            \App\CommandHandlers\Actor\UpdateActorHandler::class,
            \App\Commands\Actor\DeleteActorCommand::class =>
            \App\CommandHandlers\Actor\DeleteActorHandler::class,
            \App\Commands\Actor\GetActorsCommand::class =>
            \App\CommandHandlers\Actor\GetActorsHandler::class,
            \App\Commands\Actor\GetActorBySearchKeyCommand::class =>
            \App\CommandHandlers\Actor\GetActorBySearchKeyHandler::class,
        ]);

        // Film
        Bus::map([
            \App\Commands\Film\GetMovieWithReviewCommand::class =>
            \App\CommandHandlers\Film\GetMovieWithReviewHandler::class,
            \App\Commands\Film\GetMoviesByCategoryNameCommand::class =>
            \App\CommandHandlers\Film\GetMoviesByCategoryNameHandler::class,
            \App\Commands\Film\GetMoviesCommand::class =>
            \App\CommandHandlers\Film\GetMoviesHandler::class,
            \App\Commands\Film\AddToFavoriteCommand::class =>
            \App\CommandHandlers\Film\AddToFavoriteHandler::class,
            \App\Commands\Film\RemoveFromFavoriteCommand::class =>
            \App\CommandHandlers\Film\RemoveFromFavoriteHandler::class,
            \App\Commands\Film\DeleteMovieCommand::class =>
            \App\CommandHandlers\Film\DeleteMovieHandler::class,
            \App\Commands\Film\DeleteReviewCommand::class =>
            \App\CommandHandlers\Film\DeleteReviewHandler::class,
            \App\Commands\Film\RateMovieCommand::class =>
            \App\CommandHandlers\Film\RateMovieHandler::class,
            \App\Commands\Film\ReviewMovieCommand::class =>
            \App\CommandHandlers\Film\ReviewMovieHandler::class,
            \App\Commands\Film\UpdateMovieCommand::class =>
            \App\CommandHandlers\Film\UpdateMovieHandler::class,
            \App\Commands\Film\CreateMovieCommand::class =>
            \App\CommandHandlers\Film\CreateMovieHandler::class,
        ]);

        // Category
        Bus::map([
            \App\Commands\Category\GetCategoryCommand::class =>
            \App\CommandHandlers\Category\GetCategoryHandler::class,
            \App\Commands\Category\CreateCategoryCommand::class =>
            \App\CommandHandlers\Category\CreateCategoryHandler::class,
            \App\Commands\Category\UpdateCategoryCommand::class =>
            \App\CommandHandlers\Category\UpdateCategoryHandler::class,
            \App\Commands\Category\DeleteCategoryCommand::class =>
            \App\CommandHandlers\Category\DeleteCategoryHandler::class,
        ]);

        // Admin
        Bus::map([
            \App\Commands\Admin\GetAdminsCommand::class =>
            \App\CommandHandlers\Admin\GetAdminsHandler::class,
            \App\Commands\Admin\CreateAdminCommand::class =>
            \App\CommandHandlers\Admin\CreateAdminHandler::class,
            \App\Commands\Admin\DeleteAdminCommand::class =>
            \App\CommandHandlers\Admin\DeleteAdminHandler::class,
            \App\Commands\Admin\UpdateAdminCommand::class =>
            \App\CommandHandlers\Admin\UpdateAdminHandler::class,
        ]);

        // Message
        Bus::map([
            \App\Commands\Message\GetMessagesCommand::class =>
            \App\CommandHandlers\Message\GetMessagesHandler::class,
            \App\Commands\Message\DeleteMessageCommand::class =>
            \App\CommandHandlers\Message\DeleteMessageHandler::class,
        ]);

        // Rating
        Bus::map([
            \App\Commands\Rating\GetRatingsCommand::class =>
            \App\CommandHandlers\Rating\GetRatingsHandler::class,
            \App\Commands\Rating\DeleteRatingCommand::class =>
            \App\CommandHandlers\Rating\DeleteRatingHandler::class,
        ]);

        // Review
        Bus::map([
            \App\Commands\Review\GetReviewsCommand::class =>
            \App\CommandHandlers\Review\GetReviewsHandler::class,
            \App\Commands\Review\DeleteReviewCommand::class =>
            \App\CommandHandlers\Review\DeleteReviewHandler::class,
        ]);

        // User
        Bus::map([
            \App\Commands\User\GetUsersCommand::class =>
            \App\CommandHandlers\User\GetUsersHandler::class,
            \App\Commands\User\CreateUserCommand::class =>
            \App\CommandHandlers\User\CreateUserHandler::class,
            \App\Commands\User\DeleteUserCommand::class =>
            \App\CommandHandlers\User\DeleteUserHandler::class,
            \App\Commands\User\UpdateUserCommand::class =>
            \App\CommandHandlers\User\UpdateUserHandler::class,
            \App\Commands\User\ChangePasswordCommand::class =>
            \App\CommandHandlers\User\ChangePasswordHandler::class,
            \App\Commands\User\GetFavoritesCommand::class =>
            \App\CommandHandlers\User\GetFavoritesHandler::class,
            \App\Commands\User\GetRatingsCommand::class =>
            \App\CommandHandlers\User\GetRatingsHandler::class,
            \App\Commands\User\GetReviewsCommand::class =>
            \App\CommandHandlers\User\GetReviewsHandler::class,
            \App\Commands\User\GetTransactionsCommand::class =>
            \App\CommandHandlers\User\GetTransactionsHandler::class,
            \App\Commands\User\UpdateProfileCommand::class =>
            \App\CommandHandlers\User\UpdateProfileHandler::class,
        ]);

        // Dashboard
        Bus::map([
            \App\Commands\Dashboard\GetDashboardCommand::class =>
            \App\CommandHandlers\Dashboard\GetDashboardHandler::class,
        ]);

        // Home
        Bus::map([
            \App\Commands\Home\SendMessageCommand::class =>
            \App\CommandHandlers\Home\SendMessageHandler::class,
            \App\Commands\Home\GetDataHomeCommand::class =>
            \App\CommandHandlers\Home\GetDataHomeHandler::class,
        ]);
    }
}
