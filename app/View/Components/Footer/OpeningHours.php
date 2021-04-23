<?php

namespace App\View\Components\Footer;

use Illuminate\View\Component;

class OpeningHours extends Component
{
    private $hours;
    private $visible = ['mon','tue','wed','thu','fri'];
    public $days;
    public $is_open;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->hours = config('settings.hours');
        $this->days = $this->formatDays();
        $this->is_open = $this->isOpen();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.footer.opening-hours');
    }

    public function formatDays()
    {
        $days = [];
        foreach($this->hours as $day => $interval) {
            if (in_array($day, $this->visible)) {
                $days[$day] = (!empty($interval)) ? implode(' &nbsp;&nbsp; ', $interval) : 'Nestránkový deň';
            }
        }
        return $days;
    }

    private function isOpen()
    {
      $status_today = strtolower(date("D"));
      $current_time = strtotime("now");

      $is_open = false;
      foreach($this->hours[$status_today] as $each_interval) {

          $each_interval = explode("-", $each_interval);
          $each_interval[0] = strtotime($each_interval[0]);
          $each_interval[1] = strtotime($each_interval[1]);

          if (($each_interval[0] <= $current_time) && ($each_interval[1] >= $current_time)) {
              $is_open = true;
              break;
          }
      }

      return $is_open;
    }
}
