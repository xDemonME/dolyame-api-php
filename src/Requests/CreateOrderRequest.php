<?php

namespace VKolegov\DolyameAPI\Requests;

use VKolegov\DolyameAPI\Entities\ClientInfo;

class CreateOrderRequest extends AbstractOrderRequest
{
    // TODO: what is it?
    private ?array $fiscalizationSettings = null;
    /**
     * @var \VKolegov\DolyameAPI\Entities\ClientInfo|null
     */
    private ?ClientInfo $clientInfo = null;
    private ?string $notificationURL = null;
    private string $failURL;
    private string $successURL;
    private array $data = [];

    public function setFiscalizationSettings(array $fiscalizationSettings): CreateOrderRequest
    {
        $this->fiscalizationSettings = $fiscalizationSettings;
        return $this;
    }

    public function setClientInfo(ClientInfo $clientInfo): CreateOrderRequest
    {
        $this->clientInfo = $clientInfo;
        return $this;
    }

    public function setNotificationURL(string $notificationURL): CreateOrderRequest
    {
        $this->notificationURL = $notificationURL;
        return $this;
    }

    public function setFailURL(string $failURL): CreateOrderRequest
    {
        $this->failURL = $failURL;
        return $this;
    }

    public function setSuccessURL(string $successURL): CreateOrderRequest
    {
        $this->successURL = $successURL;
        return $this;
    }

    public function addData(string $key, $val): CreateOrderRequest
    {
        $this->data[$key] = (string) $val;
        return $this;
    }

    public function toArray(): array
    {
        $return = [
            'order' => [
                'id' => $this->id,
                'amount' => $this->amount,
                'prepaid_amount' => $this->prepaidAmount ?? 0,
                'items' => $this->items->toArray(),
                'client_info' => $this->clientInfo->toArray(),
            ],
            'fiscalization_settings' => $this->fiscalizationSettings,
            'notification_url' => $this->notificationURL,
            'fail_url' => $this->failURL,
            'success_url' => $this->successURL,
        ];

        if ($this->data) {
            $return['data'] = $this->data;
        }
        return $return;
    }
}
