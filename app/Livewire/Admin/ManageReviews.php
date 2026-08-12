<?php

namespace App\Livewire\Admin;

use App\Models\VisitorReview;
use Livewire\Component;
use Livewire\WithPagination;

use WireUi\Traits\WireUiActions;

class ManageReviews extends Component
{
    use WithPagination, WireUiActions;

    public function toggleApproval($id)
    {
        $review = VisitorReview::findOrFail($id);
        $review->is_approved = !$review->is_approved;
        $review->save();
        $this->notification()->success(
            $title = __('Success'),
            $description = __('Review status updated successfully.')
        );
    }

    public function confirmDeleteReview($id)
    {
        $this->dialog()->confirm([
            'title'       => __('Are you sure?'),
            'description' => __('Do you want to delete this visitor review?'),
            'icon'        => 'error',
            'accept'      => [
                'label'  => __('Yes, delete it'),
                'method' => 'deleteReview',
                'params' => $id,
            ],
            'reject' => [
                'label'  => __('Cancel'),
            ],
        ]);
    }

    public function deleteReview($id)
    {
        VisitorReview::findOrFail($id)->delete();
        $this->notification()->success(
            $title = __('Success'),
            $description = __('Review deleted successfully.')
        );
    }

    public function render()
    {
        $reviews = VisitorReview::latest()->paginate(10);
        return view('livewire.admin.manage-reviews', ['reviews' => $reviews]);
    }
}
