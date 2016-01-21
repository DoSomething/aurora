<?php

namespace Aurora;

use Aurora\Models\User as AuroraUser;

class NorthstarUser extends APIResponseModel
{
    /**
     * Phoenix API
     * @var \Aurora\Services\Drupal
     */
    protected $drupal;

    /**
     * Raw profile data from Northstar.
     * @var array
     */
    protected $attributes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function __construct($attributes)
    {
        $this->drupal = app('Aurora\Services\Drupal');

        $this->attributes = $attributes;
    }

    /**
     * Get the user's display name.
     * @return mixed|string
     */
    public function displayName()
    {
        if (!empty($this->first_name) && !empty($this->last_initial)) {
            return $this->first_name.' '.$this->last_initial.'.';
        }

        return $this->id;
    }

    /**
     * Get all user's campaigns
     *
     * @return array user's campaigns
     */
    public function getCampaigns()
    {
        $campaigns = [];
        $profile = $this->profile;

        if (isset($profile['campaigns'])) {
            foreach ($profile['campaigns'] as $campaign) {
                if (isset($campaign['drupal_id'])) {
                    array_push($campaigns, $this->drupal->getCampaignFromDrupal($campaign['drupal_id']));
                }
            }
        }

        return array_filter($campaigns);
    }

    /**
     * Get all user's reportbacks
     *
     * @return array user's reportbacks
     */
    public function getReportbacks()
    {
        $reportbacks = [];
        $profile = $this->profile;

        if (isset($profile['campaigns'])) {
            foreach ($profile['campaigns'] as $campaign) {
                if (isset($campaign['reportback_id'])) {
                    array_push($reportbacks, $this->drupal->getReportbacksFromDrupal($campaign['reportback_id']));
                }
            }
        }

        return array_filter($reportbacks);
    }
}
