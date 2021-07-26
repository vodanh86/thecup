<?php

namespace App\Admin\Controllers;

abstract class Constant
{
    const PAGE_STATUS = array( 1 => "Đã duyệt", 0 => 'Chưa duyệt', -1 => 'Xoá');
    const SHOW_STATUS = array(0 => 'Ẩn', 1 => 'Hiện');
    const SWITCH_STATE = array(
        'on'  => ['value' => 1, 'text' => '&nbsp;Hiện  ', 'color' => 'success'],
        'off' => ['value' => 0, 'text' => '&nbsp;&nbsp;Ẩn&nbsp;&nbsp;', 'color' => 'danger'],
    );
    const ON_STATE = array(
        'on'  => ['value' => 1, 'text' => '&nbsp;Có  ', 'color' => 'success'],
        'off' => ['value' => 0, 'text' => '&nbsp;&nbsp;Không&nbsp;&nbsp;', 'color' => 'danger'],
    );
    const ORDER_STATUS = array(0 => 'Mới tạo', 1 => 'Thanh toán xong', 2 => "Thanh toán lỗi");
    const YES_NO_STATUS = array(0 => 'Không', 1 => 'Có');
    const BANNER_POSITION = array(1 => 'Center', 3 => "Đơn vị sự nghiệp",
                                  4 => "Trường học", 0 => 'Slider',  
                                  2 => 'Quận - Huyện', 5 => "Khác");
}
?>