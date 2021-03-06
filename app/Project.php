<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Storage;

class Project extends Model
{
	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'slug';
	}

	/**
	 * Get the user who created this project.
	 */
	public function author()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the releases assigned to this project.
	 */
	public function releases()
	{
		return $this->hasMany('App\Release');
	}

	/**
	 * Get uploaded media assigned to this project.
	 */
	public function media()
	{
		return $this->hasMany('App\Media');
	}

	/**
	 * Get wiki pages assigned to this project.
	 */
	public function pages()
	{
		return $this->hasMany('App\WikiPage');
	}

	/**
	 * Get the maintainers of this project.
	 */
	public function maintainers()
	{
		return $this->belongsToMany('App\User', 'maintainers');
	}

	/**
	 * Check if a custom logo has been uploaded for this project.
	 *
	 * @return boolean
	 */
	public function getDoesLogoExistAttribute() {
		return Storage::disk('logos')->exists($this->logo);
	}

	/**
	 * Check if a custom banner has been uploaded for this project.
	 *
	 * @return boolean
	 */
	public function getDoesBannerExistAttribute() {
		return Storage::disk('banners')->exists($this->banner);
	}

	/**
	 * Check if a custom banner thumbnail has been uploaded for this project.
	 *
	 * @return boolean
	 */
	public function getDoesBannerThumbnailExistAttribute() {
		if (!$this->banner_thumbnail)
			return false;
		
		return Storage::disk('banners')->exists('thumbnails/'.$this->banner_thumbnail);
	}

	/**
	 * Get the logo URL for this project.
	 *
	 * @return string
	 */
	public function getLogoUrlAttribute() {
		return $this->doesLogoExist ? config('filesystems.disks.logos.url').'/'.$this->logo: '';
	}

	/**
	 * Get the banner URL for this project.
	 *
	 * @return string
	 */
	public function getBannerUrlAttribute() {
		return $this->doesBannerExist ? config('filesystems.disks.banners.url').'/'.$this->banner: '';
	}

	/**
	 * Get the banner thumbnail URL for this project.
	 *
	 * @return string
	 */
	public function getBannerThumbnailUrlAttribute() {
		return $this->doesBannerThumbnailExist ? config('filesystems.disks.banners.url').'/thumbnails/'.$this->banner_thumbnail: '';
	}
}
