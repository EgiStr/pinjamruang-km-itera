<?php

namespace App\Admin\Controllers;

use App\Enums\ApprovalStatus;
use App\Models\BorrowRoom;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Carbon\Carbon;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Form\Field;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BorrowRoomController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Pinjam Ruang')
            ->description(trans('admin.list'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Pinjam Ruang')
            ->description(trans('admin.show'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Pinjam Ruang')
            ->description(trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Pinjam Ruang')
            ->description(trans('admin.create'))
            ->body($this->form());
    }
    // delete borrowed room
    public function delete($id)
    {
        $borrow_room = BorrowRoom::find($id);
        $borrow_room->delete();

        return redirect()->back();
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BorrowRoom);

        $admin_user = \Admin::user();
        // Show query only related to roles

        if ($admin_user->isRole('mahasiswa'))
            $grid->model()->where('borrower_id', $admin_user->id);

        $grid->id('ID');
        $grid->column('borrower.name', 'Peminjam');
        $grid->column('room.name', 'Ruangan');
        $grid->column('borrow_at', 'Mulai Pinjam')->display(function ($borrow_at) {
            return Carbon::parse($borrow_at)->format('d M Y H:i');
        });
        $grid->column('until_at', 'Lama Pinjam')->display(function ($title, $column) {
            $borrow_at = Carbon::parse($this->borrow_at);
            $until_at = Carbon::parse($title);

            return $until_at->diffForHumans($borrow_at);
        });
        $grid->column('status', 'Status')->display(function ($title, $column) {
            $admin_approval_status = $this->admin_approval_status;
            $finished_at = $this->finished_at ?? null;


            if ($admin_approval_status == 1) {
                if ($finished_at != null)
                    $val = ['success', 'Peminjaman selesai'];
                else
                    $val = ['success', 'Sudah disetujui Admin'];
            } else if ($admin_approval_status == 0)
                $val = ['info', 'Menunggu persetujuan Admin'];
            else
                $val = ['danger', 'Ditolak Admin'];


            return '<span class="label-' . $val[0] . '" style="width: 8px;height: 8px;padding: 0;border-radius: 50%;display: inline-block;"></span>&nbsp;&nbsp;'
                . $val[1];
        });

        // Role & Permission
        if (!\Admin::user()->can('create.borrow_rooms'))
            $grid->disableCreateButton();

        $grid->actions(function ($actions) {

            // The roles with this permission will not able to see the view button in actions column.
            if (!\Admin::user()->can('edit.borrow_rooms')) {
                $actions->disableEdit();
            }
            // The roles with this permission will not able to see the show button in actions column.
            if (!\Admin::user()->can('list.borrow_rooms')) {
                $actions->disableView();
            }
            // The roles with this permission will not able to see the delete button in actions column.
            if (!\Admin::user()->can('delete.borrow_rooms')) {
                $actions->disableDelete();
            }
        });

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
        $show = new Show(BorrowRoom::findOrFail($id));

        $show->id('ID');
        $show->field('borrower.name', 'Peminjam');
        $show->field('room.name', 'Ruangan');
        $show->field('borrow_at', 'Mulai Pinjam');
        $show->field('until_at', 'Selesai Pinjam');
        $show->field('finished_at', 'Diselesaikan Pada');
        $show->field('notes', 'Catatan');

        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));
        // display surat peminjaman to download the file
        $show->field('surat_peminjaman', 'Peminjaman Surat')->as(function ($surat_peminjaman) {
            return "<a href='" . $surat_peminjaman . "' target='_blank'>Lihat</a>";
        })->unescape();



        // Role & Permission
        $show->panel()
            ->tools(function ($tools) {
                // The roles with this permission will not able to see the view button in actions column.
                if (!\Admin::user()->can('edit.borrow_rooms'))
                    $tools->disableEdit();

                // The roles with this permission will not able to see the show button in actions column.
                if (!\Admin::user()->can('list.borrow_rooms'))
                    $tools->disableList();

                // The roles with this permission will not able to see the delete button in actions column.
                if (!\Admin::user()->can('delete.borrow_rooms'))
                    $tools->disableDelete();
            });

        return $show;
    }
    // delete surat peminjaman file
    public function deleteSuratPeminjaman($id)
    {
        $borrow_room = BorrowRoom::find($id);
        $borrow_room->surat_peminjaman = null;
        $borrow_room->save();

        return redirect()->back();
    }


    // delete borrowed room
    public function deleteBorrowedRoom($id)
    {
        $borrow_room = BorrowRoom::find($id);
        $borrow_room->delete();

        return redirect()->back();
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BorrowRoom);
        $admin_user = \Admin::user();

        if ($form->isEditing())
            $form->display('id', 'ID');


        $form->select('borrower_id', 'Peminjam')->options(function ($id) {
            $college_students = Administrator::find($id);
            if ($college_students)
                return [$college_students->id => $college_students->name];
        })->ajax('/admin/api/college-students');
        $form->select('room_id', 'Ruangan')->options(function ($id) {
            $room = Room::find($id);
            if ($room)
                return [$room->id => $room->name];
        })->ajax('/admin/api/rooms');
        $form->datetime('borrow_at', 'Mulai Pinjam')->format('YYYY-MM-DD HH:mm');
        $form->datetime('until_at', 'Selesai Pinjam')->format('YYYY-MM-DD HH:mm');


        // Approval Lecturer

        // Approval administration and etc
        $form->radio('admin_approval_status', 'Status Persetujuan Admin')->options(ApprovalStatus::asSelectArray());
        $form->textarea('notes', 'Catatan');

        if ($form->isEditing()) {
            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        }
        $form->display('surat_peminjaman', trans('surat_peminjaman'))->with(function ($surat_peminjaman) {
            // download surat peminjaman
            return "<a href='" . $surat_peminjaman . "' target='_blank'>Download</a>";
        });

        $form->saving(function (Form $form) {
            // if ($form->admin_id)
            $form->admin_id = \Admin::user()->id;
        });

        return $form;
    }
}
