<?php

namespace App;

class BannerDTO
{
    private string $ipAddress;
    private string $userAgent;
    private string $pageUrl;
    private string $viewDate;

    public function __construct(IDatabaseAdapter $adapter, string $ipAddress, string $userAgent, string $pageUrl, string $viewDate)
    {
        $this->validateIpAddress($ipAddress);
        $this->validateUserAgent($userAgent);
        $this->validatePageUrl($pageUrl);

        $this->ipAddress = $adapter->escapeString($ipAddress);
        $this->userAgent = $adapter->escapeString($userAgent);
        $this->pageUrl = $adapter->escapeString($pageUrl);
        $this->viewDate = $viewDate;
    }

    private function validateIpAddress(string $ipAddress): void
    {
        if (!filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException("Invalid IP address: $ipAddress");
        }
    }

    private function validateUserAgent(string $userAgent): void
    {
        if (empty($userAgent)) {
            throw new \InvalidArgumentException("User agent cannot be empty");
        }
    }

    private function validatePageUrl(string $pageUrl): void
    {
        if (!filter_var($pageUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException("Invalid page URL: $pageUrl");
        }
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getPageUrl(): string
    {
        return $this->pageUrl;
    }

    public function getViewDate(): string
    {
        return $this->viewDate;
    }
}