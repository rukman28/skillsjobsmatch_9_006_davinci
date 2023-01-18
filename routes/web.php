<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\JobDescriptionController;
use App\Http\Controllers\User\JobsRSSFeedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Editor\ProgrammeController;
use App\Http\Controllers\Editor\EditorController;
use App\Http\Controllers\Editor\SkillCategoryController;
use App\Http\Controllers\Editor\SkillsController;
use App\Http\Controllers\Editor\LevelController;
use App\Http\Controllers\Editor\ModulesController;
use App\Http\Controllers\Editor\PracticalsController;
use App\Http\Controllers\User\UserProgrammeDetailsController;
use App\Http\Controllers\User\SkillSearchController;
use App\Http\Controllers\User\SkillsAIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RolesController::class);
    Route::post('/roles/{role}/permissions', [RolesController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RolesController::class, 'removePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions', PermissionController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/users/{user}/roles', [UserController::class, 'showRoles'])->name('users.roles.show');
    Route::get('/users/{user}/assign', [UserController::class, 'showRolesPermissionAssign'])->name('users.show.roles.permission.assign');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRoles'])->name('users.roles.assign');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRoles'])->name('users.roles.revoke');
    Route::get('/users/{user}/permissions', [UserController::class, 'showPermissions'])->name('users.permissions.show');
    Route::post('/users/{user}/permissions', [UserController::class, 'assignPermissions'])->name('users.permissions.assign');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'removePermissions'])->name('users.permissions.revoke');
});

Route::middleware(['auth', 'role:editor'])->name('editor.')->prefix('editor')->group(function () {
    Route::get('/dashboard', [EditorController::class, 'index'])->name('index');
    Route::get('/programmes', [ProgrammeController::class, 'index'])->name('programme.index');
    Route::get('/add-new-programme', [ProgrammeController::class, 'addProgrammeView'])->name('programme.add.view');
    Route::post('/add-new-programme', [ProgrammeController::class, 'storeProgramme'])->name('programme.store');
    Route::get('/update-programme-name/{programme_id}', [ProgrammeController::class, 'editProgrammeView'])->name('programme.name.update.view');
    Route::post('/update-programme/name', [ProgrammeController::class, 'updateProgramme'])->name('programme.name.update.submission');
    Route::get('/delete-programme/{programme_id}', [ProgrammeController::class, 'deleteProgramme'])->name('programme.delete');
    Route::get('/programme/view-bin', [ProgrammeController::class, 'showProgrammeBin'])->name('programme.show.bin');
    Route::get('/programme/bin/delete/{id}', [ProgrammeController::class, 'forceDelete'])->name('programme.bin.delete');
    Route::get('/programme/bin/restore/{id}',[ProgrammeController::class, 'restore'])->name('programme.bin.restore');
    Route::get('/programme-details/{id}', [ProgrammeController::class, 'showDetails'])->name('programme.details');
    Route::get('/programme/{id}/skills', [ProgrammeController::class, 'getProgrammeSkills'])->name('programme.show.skills');
    Route::get('/programme/module-delete/{module_id}/{programme_id}', [ProgrammeController::class, 'removeModule'])->name('programme.module.remove');
    Route::get('/programme/level-delete/{level_id}/{programme_id}', [ProgrammeController::class, 'removeLevel'])->name('programme.level.remove');
    Route::get('/programme/skill/search-by-title/{title}', [ProgrammeController::class, 'getSkillByTitle'])->name('programme.skill.by.title');

    Route::get('/levels', [LevelController::class, 'index'])->name('levels.index');
    Route::get('/levels/{id}', [LevelController::class, 'showDetails'])->name('level.details');
    Route::get('/level/new', [LevelController::class, 'addNewLevelView'])->name('level.add.view');
    Route::post('level/store', [LevelController::class, 'storeLevel'])->name('level.store');
    Route::get('/level/view-bin', [LevelController::class, 'showLevelsBin'])->name('level.show.bin');
    Route::get('/levels/update/view/{level_id}', [LevelController::class, 'updateLevelNameView'])->name('level.update.view');
    Route::post('/levels/update', [LevelController::class, 'updateLevelName'])->name('level.update');
    Route::get('/delete-level/{level_id}', [LevelController::class, 'deleteLevel'])->name('level.delete');
    Route::delete('/levels/remove-modules', [LevelController::class, 'removeModule'])->name('levels.remove.modules');
    Route::delete('/level/programmes/remove-programme', [LevelController::class, 'removeProgramme'])->name('levels.remove.programme');
    Route::get('/level/bin/delete/{id}', [LevelController::class, 'forceLevelDelete'])->name('level.bin.delete');
    Route::get('/level/bin/restore/{id}',[LevelController::class, 'restoreLevel'])->name('level.bin.restore');

    Route::get('/modules', [ModulesController::class, 'index'])->name('modules.index');
    Route::get('module/{id}', [ModulesController::class, 'showDetails'])->name('module.details');

    Route::get('/module/{id}/add-programme', [ModulesController::class, 'showAvailableProgrammesToModule'])->name('module.add.programme.view');
    Route::post('/module/add-programme', [ModulesController::class, 'addProgrammeToModule'])->name('module.add.programme');
    Route::delete('/module/remove-programme', [ModulesController::class, 'removeProgramme'])->name('module.remove.programme');
    Route::delete('/module/remove-practical', [ModulesController::class, 'removePractical'])->name('module.remove.practical');
    Route::get('/new-module', [ModulesController::class, 'addNewModuleView'])->name('module.add.view');
    Route::post('/new-module', [ModulesController::class, 'storeNewModule'])->name('module.store');
    Route::get('/edit-module/{id}', [ModulesController::class, 'editModuleView'])->name('module.edit.view');
    Route::post('/edit-module', [ModulesController::class, 'updateModuleName'])->name('module.update.name');
    Route::get('/remove-module/{module_id}', [ModulesController::class, 'removeModule'])->name('module.delete');
    Route::get('/modules/view-bin', [ModulesController::class, 'showModulesBin'])->name('modules.show.bin');
    Route::get('/module/bin/delete/{id}', [ModulesController::class, 'forceModuleDelete'])->name('modules.bin.delete');
    Route::get('/module/bin/restore/{id}',[ModulesController::class, 'restoreModule'])->name('modules.bin.restore');
    Route::get('/module/{module_id}/show/available-practicals',[ModulesController::class, 'showAvailablePracticals'])->name('modules.show.available.practicals');
    Route::post('/module/practicals/store',[ModulesController::class, 'storeModulePracticals'])->name('modules.practicals.store');

    Route::get('/practicals', [PracticalsController::class, 'index'])->name('practicals.index');
    Route::get('/practical/{id}', [PracticalsController::class, 'showDetails'])->name('practical.details');
    Route::get('/practicals', [PracticalsController::class, 'index'])->name('practicals.index');
    Route::get('/practical/{practical_id}/skills', [PracticalsController::class, 'showSkillsForPractical'])->name('practical.skills');
    Route::delete('/practical/skill-delete/', [PracticalsController::class, 'destroyPracticalSkill'])->name('practical.skill.delete');
    Route::get('/practical/{practical_id}/show/available-skills', [PracticalsController::class, 'showAvailableSkills'])->name('practical.show.available.skill');
    Route::post('/practical/store/skill', [PracticalsController::class, 'addSkillToPractical'])->name('practical.store.skill');
    Route::delete('/practical/module/remove', [PracticalsController::class, 'removeModuleFromPractical'])->name('practical.module.remove');
    Route::delete('/practical/skill-categories/remove', [PracticalsController::class, 'removeCategoryFromPractical'])->name('practical.skillcategory.remove');
    Route::get('/practical-new-practical', [PracticalsController::class, 'addNewPracticalView'])->name('practical.add.new.view');
    Route::post('/practical/new', [PracticalsController::class, 'addNewPractical'])->name('practical.store');
    Route::get('/practical/edit/{practical_id}', [PracticalsController::class, 'editPracticalName'])->name('practical.edit.name');
    Route::post('/practical/update-name', [PracticalsController::class, 'updatePracticalName'])->name('practical.update.name');
    Route::get('/practical/remove/{practical_id}', [PracticalsController::class, 'removePractical'])->name('practical.delete');
    Route::get('/practicals/view-bin', [PracticalsController::class, 'showPracticalsBin'])->name('practicals.show.bin');
    Route::get('/practical/bin/delete/{id}', [PracticalsController::class, 'forceDelete'])->name('practical.force.delete');
    Route::get('/practical/restore/{id}', [PracticalsController::class, 'restore'])->name('practical.restore');

    Route::get('/skill-categories', [SkillCategoryController::class, 'index'])->name('skill-categories.index');
    Route::get('/skill-category/{id}', [SkillCategoryController::class, 'showDetails'])->name('skill-category.details');
    Route::get('/skills', [SkillsController::class, 'index'])->name('skills.index');
    Route::get('/skill/details/{id}', [SkillsController::class, 'showDetails'])->name('skill.show.details');
    Route::delete('/skill-category/remove-skill', [SkillCategoryController::class, 'removeSkill'])->name('skill-category.skill.remove');
    Route::get('/skill-category/edit/{id}', [SkillCategoryController::class, 'showEditView'])->name('skill-category.edit.view');
    Route::post('/skill-category/update', [SkillCategoryController::class, 'updateSkillsCategoryName'])->name('skill-category.name.update');
    Route::get('/skill-category/remove/{id}', [SkillCategoryController::class, 'removeSkillsCategory'])->name('skill-category.remove');
    Route::get('/new/skill-category', [SkillCategoryController::class, 'addNewSkillsCategoryView'])->name('skill-categories.add.new.view');
    Route::post('/new/skill-category', [SkillCategoryController::class, 'storeNewSkillsCategory'])->name('skill-category.store');
    Route::get('/skill-category/{skill_cate_id}/view/practicals', [SkillCategoryController::class, 'showPracticals'])->name('skill-categories.show.practicals');
    Route::delete('/skill-category/remove/practical', [SkillCategoryController::class, 'removePractical'])->name('skill-categories.remove.practical');
    Route::get('/skill-categories/view-bin', [SkillCategoryController::class, 'showBin'])->name('skill-categories.show.bin');
    Route::get('/skill-categories/bin/delete/{id}', [SkillCategoryController::class, 'forceDelete'])->name('skill-categories.force.delete');
    Route::get('/skill-categories/restore/{id}', [SkillCategoryController::class, 'restore'])->name('skill-categories.restore');

    Route::get('/skill/new', [SkillsController::class, 'addNewSkillView'])->name('skill.new.view');
    Route::post('/skill/new', [SkillsController::class, 'storeSkillDetails'])->name('skill.store');
    Route::delete('/skill/remove-practical', [SkillsController::class, 'removePractical'])->name('skill.remove.practical');
    Route::get('/skill/edit/{id}', [SkillsController::class, 'editSkill'])->name('skill.edit.view');
    Route::post('/skill/update', [SkillsController::class, 'updateSkillDetails'])->name('skill.update');
    Route::get('/skill/delete/{id}', [SkillsController::class, 'deleteSkill'])->name('skill.remove');
    Route::get('/skills/view-bin', [SkillsController::class, 'showBin'])->name('skills.show.bin');
    Route::get('/skills/bin/delete/{id}', [SkillsController::class, 'forceDelete'])->name('skills.force.delete');
    Route::get('/skills/restore/{id}', [SkillsController::class, 'restore'])->name('skills.restore');
    Route::get('/skill/{id}/modules', [SkillsController::class, 'getModulesBySkillId'])->name('skill.show.modules');

});

Route::middleware(['auth', 'role:user'])->name('user.')->prefix('user')->group(function () {
    Route::get('/dashboard', [UserProgrammeDetailsController::class, 'index'])->name('dashboard');
    //Route::get('/', [UserProgrammeDetailsController::class, 'index'])->name('index');
    Route::get('/programme-selection', [UserProgrammeDetailsController::class, 'selectProgramme'])->name('select.programme');
    Route::post('/programme-selection', [UserProgrammeDetailsController::class, 'storeProgramme'])->name('store.programme');
    Route::get('/module-selection', [UserProgrammeDetailsController::class, 'selectModules'])->name('select.modules');
    Route::post('/module-selection', [UserProgrammeDetailsController::class, 'storeUserModules'])->name('store.modules');
    Route::get('/modules', [UserProgrammeDetailsController::class, 'showUserModules'])->name('show.modules');
    Route::get('/module/delete/{id}/', [UserProgrammeDetailsController::class, 'deleteUserModule'])->name('delete.module');
    Route::get('/programme-change', [UserProgrammeDetailsController::class, 'changeProgramme'])->name('change.programme');
    Route::get('/modules_by_level', [UserProgrammeDetailsController::class, 'showModulesByLevel'])->name('modules.by.level');
    Route::get('/traverse/user_programme_details/item/{item_name}/id/{item_id}',[UserProgrammeDetailsController::class, 'programmeDetailTraverser'])->name('programme_detail.traverser');
    Route::get('/practicals', [UserProgrammeDetailsController::class, 'userPracticals'])->name('view.practicals');
    Route::get('/basic-search', [SkillSearchController::class, 'showSkillsSearchForm'])->name('view.basic.search');
    Route::post('/basic-search-result', [SkillSearchController::class, 'searchForGivenSkill'])->name('basic.search.result');
    Route::get('/skill-details/{id}',[SkillSearchController::class, 'showSkillDetails'])->name('basic.skill.details')->where('id','[0-9]+');
    Route::get('/job-description-search',[JobDescriptionController::class, 'showAddJObDescriptionPage'])->name('view.job.description.form');
    Route::post('/job-description-search',[JobDescriptionController::class, 'jobDescriptionSearch'])->name('view.job.description.result');

    Route::get('/user/skills', [UserProgrammeDetailsController::class, 'userSkills'])->name('view.skills');
    Route::get('/generate/cover_letter/form', [SkillsAIController::class, 'generateCoverLetterForm'])->name('generate.cover_letter.form');
    Route::post('/generate/cover_letter', [SkillsAIController::class, 'generateCoverLetter'])->name('generate.cover_letter');
    Route::get('/generate/questions/form', [SkillsAIController::class, 'generateQAForm'])->name('generate.questions.answers.form');
    Route::post('/generate/questions/', [SkillsAIController::class, 'generateQAResult'])->name('generate.questions.answers');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
