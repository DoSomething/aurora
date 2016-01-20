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

    public function displayName()
    {
        if(isset($this->first_name) && isset($this->last_initial)) {
            return $this->first_name.' '.$this->last_initial.'.';
        }

        return $this->id;
    }

    public function auroraUser()
    {
        return AuroraUser::find($this->id);
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

    /**
     * Used in UsersController->show()
     *
     * @return array - roles this user has
     */
    public function getRoles($id)
    {
        $roles = [];
        $user = $this->auroraUser();
        if (! empty($user)) {
            foreach ($user->roles as $role) {
                $roles[] = $role->getAttributes();
            }
        }

        return $roles;
    }

    /**
     * Used in UsersController->show()
     *
     * @return array - roles this user doesn't have
     */
    public function unassignedRoles($user_roles)
    {
        $all_roles = ['1' => 'admin', '2' => 'staff', '3' => 'intern'];
        $unassigned_roles = array_diff($all_roles, $user_roles);
        if (! in_array('staff', $unassigned_roles)) {
            $unassigned_roles = ['1' => 'ADMIN'];
        }
        foreach ($unassigned_roles as $key => $value) {
            $unassigned_roles[$key] = ucfirst($value);
        }

        return $unassigned_roles;
    }
}
