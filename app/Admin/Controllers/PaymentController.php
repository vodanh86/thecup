<?php

namespace App\Admin\Controllers;

use App\Models\Payment;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PaymentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Payment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Payment());

        $grid->column('id', __('Id'));
        $grid->column('amount', __('Amount'));
        $grid->column('bank_code', __('Bank code'));
        $grid->column('bank_tran_no', __('Bank tran no'));
        $grid->column('card_type', __('Card type'));
        $grid->column('order_info', __('Order info'));
        $grid->column('paydate', __('Paydate'));
        $grid->column('response_code', __('Response code'));
        $grid->column('tmn_code', __('Tmn code'));
        $grid->column('transaction_no', __('Transaction no'));
        $grid->column('txn_ref', __('Txn ref'));
        $grid->column('vnp_web', __('Vnp web'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->model()->orderBy('id', 'desc');
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Payment::findOrFail($id));

        $show->field('it', __('It'));
        $show->field('amount', __('Amount'));
        $show->field('bank_code', __('Bank code'));
        $show->field('bank_tran_no', __('Bank tran no'));
        $show->field('card_type', __('Card type'));
        $show->field('order_info', __('Order info'));
        $show->field('paydate', __('Paydate'));
        $show->field('response_code', __('Response code'));
        $show->field('tmn_code', __('Tmn code'));
        $show->field('transaction_no', __('Transaction no'));
        $show->field('txn_ref', __('Txn ref'));
        $show->field('vnp_web', __('Vnp web'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Payment());

        $form->number('it', __('It'));
        $form->text('amount', __('Amount'));
        $form->text('bank_code', __('Bank code'));
        $form->text('bank_tran_no', __('Bank tran no'));
        $form->text('card_type', __('Card type'));
        $form->text('order_info', __('Order info'));
        $form->datetime('paydate', __('Paydate'))->default(date('Y-m-d H:i:s'));
        $form->text('response_code', __('Response code'));
        $form->text('tmn_code', __('Tmn code'));
        $form->text('transaction_no', __('Transaction no'));
        $form->text('txn_ref', __('Txn ref'));
        $form->text('vnp_web', __('Vnp web'));

        return $form;
    }
}
