@extends('backend.layouts.app')

@section('title')
{{ __($module_action) }} {{ __($module_title) }}
@endsection

@push('after-styles')
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="mb-4">{{ __('messages.gift_cards_list') }}</h3>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ __('messages.delivery_method') }}</th>
                <th>{{ __('messages.sender_name') }}</th>
                <th>{{ __('messages.recipient_name') }}</th>
                <th>{{ __('messages.sender_phone') }}</th>
                <th>{{ __('messages.recipient_phone') }}</th>
                <th>{{ __('messages.selected_services') }}</th>
                <th>{{ __('messages.subtotal') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.created_at') }}</th>
                <th>{{ __('messages.updated_at') }}</th>
                <th>{{ __('messages.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($gifts as $gift)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $gift->delivery_method ?? '-' }}</td>
                <td>{{ $gift->sender_name ?? '-' }}</td>
                <td>{{ $gift->recipient_name ?? '-' }}</td>
                <td>{{ $gift->sender_phone ?? '-' }}</td>
                <td>{{ $gift->recipient_phone ?? '-' }}</td>
                <td>{{ $gift->requested_services ?? '-' }}</td>
                <td>{{ $gift->subtotal ?? '-' }}</td>
                <td></td>
                <td>{{ $gift->created_at ? $gift->created_at->format('Y-m-d') : '-' }}</td>
                <td>{{ $gift->updated_at ? $gift->updated_at->format('Y-m-d') : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">{{ __('messages.no_gift_cards') }}</td>
                </tr>
            @endforelse
            <td>
                <a href="{{ route('edit', $item->id) }}" class="btn btn-sm btn-primary">
                    {{ __('messages.edit') }}
                </a>
            </td>
            </tbody>
        </table>
    </div>
</div>
@endsection
