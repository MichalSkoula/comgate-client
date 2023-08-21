<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Request\RequestInterface;

class GetMethods implements RequestInterface {

  /**
   * @param string|null $curr
   * @param string|null $country
   *
   */
  public function __construct(private $curr = NULL, private $country = NULL)
  {
  }


  private function getCurr() {
    return $this->curr;
  }

  private function getCountry() {
    return $this->country;
  }

  /**
   * @return array
   */
  public function getData(): array {
    $data = [];
    if ($this->getCurr()) {
      $data = [
        'curr' => $this->getCurr(),
      ];
    }
    if ($this->getCountry()) {
      $data = [
        'country' => $this->getCountry(),
      ];
    }
    $data['type'] = 'json';
    return $data;
  }


  /**
   * @return bool
   */
  public function isPost(): bool {
    return FALSE;
  }

  /**
   * @return bool
   */
  public function needParse() {
    return FALSE;
  }

  /**
   * @return string
   */
  public function getEndPoint(): string {
    return 'methods';
  }


  /**
   * @return string
   */
  public function getResponseClass(): string {
    return ComgateMethodsResponse::class;
  }

}