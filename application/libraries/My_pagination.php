<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_pagination {

    private $leftPageCount = 2;
    private $rightPageCount = 2;

    public function getPagination($totalRow, $page, $limit) {
        $pagination = new stdClass;
        $pagination->totalPage = ceil($totalRow / $limit);
        $pagination->rowPerPage = $limit;
        $pagination->nowPage = $page;
        $pagination->startRow = ($page - 1) * $limit;
        $pagination->items = array();

        //設定上一頁按鈕
        $pagination->previous = new stdClass;
        $pagination->previous->page = $page - 1;
        if($page - 1 > 0) {
            $pagination->previous->disabled = FALSE;
        } else {
            $pagination->previous->disabled = TRUE;
        }

        //設定下一頁按鈕
        $pagination->next = new stdClass;
        $pagination->next->page = $page + 1;
        if($page + 1 <= $pagination->totalPage) {
            $pagination->next->disabled = FALSE;
        } else {
            $pagination->next->disabled = TRUE;
        }

        //設定頁數按鈕
        if($pagination->totalPage <= $this->leftPageCount + $this->rightPageCount + 1) {
            $start = 1;
            $end = $pagination->totalPage;
        } else {
            if($page - $this->leftPageCount < 1) {
                $start = 1;
                $end = $start + ($this->leftPageCount + $this->rightPageCount);
            } else if($page + $this->rightPageCount > $pagination->totalPage) {
                $end = $pagination->totalPage;
                $start = $end - ($this->leftPageCount + $this->rightPageCount);
            } else {
                $start = $page - $this->leftPageCount;
                $end = $page + $this->rightPageCount;
            }
        }

        for($i = $start;$i <= $end;$i++) {
            $item = new stdClass;
            $item->page = $i;
            if($i == $page) {
                $item->active = TRUE;
            } else {
                $item->active = FALSE;
            }
            $pagination->items[] = $item;
        }

        //第一頁按鈕設定
        if($pagination->items[0]->page != 1) {
            $pagination->first = new stdClass;
            $pagination->first->page = 1;
        }

        //最後一頁按鈕設定
        if($pagination->items[count($pagination->items) - 1]->page != $pagination->totalPage) {
            $pagination->last = new stdClass;
            $pagination->last->page = $pagination->totalPage;
        }

        return $pagination;
    }

}

/* End of file Pagination.php */