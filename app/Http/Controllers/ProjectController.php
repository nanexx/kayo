<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\WikiPage;

class ProjectController extends Controller
{
	/**
	 * Displays a project page.
	 *
	 * @return void
	 */
	public function overview(Project $project)
	{
		return view('project.overview', ['project' => $project]);
	}

	/**
	 * Displays a list of maintainers for this project.
	 *
	 * @return void
	 */
	public function maintainers(Project $project)
	{
		return view('project.maintainers', ['project' => $project]);
	}

	/**
	 * Displays a list of releases for this project.
	 *
	 * @return void
	 */
	public function releases(Project $project)
	{
		return view('project.releases', [
			'project' => $project,
			'releases' => $project->releases()->orderBy('created_at', 'desc')->paginate(env('PAGINATION_MAX_RELEASES'))
		]);
	}

	/**
	 * Displays uploaded media for this project.
	 *
	 * @return void
	 */
	public function media(Project $project)
	{
		return view('project.media', [
			'project' => $project,
			'media' => $project->media()->orderBy('created_at', 'desc')->paginate(env('PAGINATION_MAX_MEDIA'))
		]);
	}

	/**
	 * Displays a page from the project wiki.
	 *
	 * @return void
	 */
	public function wiki(Project $project, WikiPage $page)
	{
		// If no pages exist show the 'wiki is empty' message.
		if (!$page->exists && $project->pages->count() == 0) {
			return view('project.wiki', [
				'project' => $project, 'page' => $page, 'empty' => true
			]);
		}

		// Attempt to load the 'home' page if no page is specified.
		if (!$page->exists) {
			$home_page = $project->pages()->whereSlug('home');

			if ($home_page->exists()) {
				$page = $home_page->first();
			} else {
				// No 'home' page, just pick the first page.
				$page = $project->pages()->first();
			}
		}

		return view('project.wiki', [
			'project' => $project, 'page' => $page
		]);
	}
}
