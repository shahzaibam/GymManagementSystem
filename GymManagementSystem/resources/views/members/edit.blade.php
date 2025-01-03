@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Member</h1>
        <a href="{{ route('members.index') }}" class="btn btn-secondary mb-3">Back to Members</a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('members.update', $member->id) }}" method="POST" class="card p-4 shadow">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    value="{{ old('name', $member->name) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="{{ old('email', $member->email) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input
                    type="text"
                    class="form-control"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $member->phone) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="membership_type" class="form-label">Membership Type</label>
                <select
                    id="membership_type"
                    name="membership_type"
                    class="form-select"
                    required>
                    <option value="Basic" {{ old('membership_type', $member->membership_type) == 'Basic' ? 'selected' : '' }}>Basic</option>
                    <option value="Premium" {{ old('membership_type', $member->membership_type) == 'Premium' ? 'selected' : '' }}>Premium</option>
                    <option value="VIP" {{ old('membership_type', $member->membership_type) == 'VIP' ? 'selected' : '' }}>VIP</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="membership_start_date" class="form-label">Membership Start</label>
                <input type="date" name="membership_start_date" id="membership_start_date" class="form-control" value="{{ old('membership_start_date', $member->membership_start_date) }}">
            </div>


            <div class="mb-3">
                <label for="membership_end_date" class="form-label">Membership End</label>
                <input type="date" name="membership_end_date" id="membership_end_date" class="form-control" value="{{ old('membership_end_date', $member->membership_end_date) }}">
            </div>


            <button type="submit" class="btn btn-primary">Update Member</button>
        </form>
    </div>
@endsection
