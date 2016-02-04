<?php

namespace Aurora;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Log;

class NorthstarUser extends APIResponseModel
{
    /**
     * Phoenix API
     * @var \Aurora\Services\Drupal
     */
    protected $drupal;

    public function __construct($attributes)
    {
        $this->drupal = app('Aurora\Services\Drupal');

        parent::__construct($attributes);
    }

    /**
     * Get the user's display name.
     * @return mixed|string
     */
    public function displayName()
    {
        if (! empty($this->first_name) && ! empty($this->last_name)) {
            return $this->first_name.' '.$this->last_name;
        }

        if (! empty($this->first_name) && ! empty($this->last_initial)) {
            return $this->first_name.' '.$this->last_initial.'.';
        }

        return $this->id;
    }

    /**
     * Get the user's formatted mobile number.
     *
     * @param string $fallback - Text to display if no mobile is set
     * @return mixed|string
     */
    public function prettyMobile($fallback = '')
    {
        if(isset($this->mobile)) {
            $phoneUtil = PhoneNumberUtil::getInstance();
            try {
                $formattedNumber = $phoneUtil->parse($this->mobile, 'US');

                return $phoneUtil->format($formattedNumber, PhoneNumberFormat::INTERNATIONAL);
            } catch (\libphonenumber\NumberParseException $e) {
                Log::error($e);

                return $this->number;
            }
        }

        return $fallback;
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
