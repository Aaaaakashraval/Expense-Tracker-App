@extends('main')
@section('mainpart')
    <!-- Profile Update Content -->
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-img-container">
                    {{-- If image exists in DB, show it, else fallback to UI avatar --}}
                    @if ($updateData->image)
                        <img src="{{ asset('uploads/profile/' . $updateData->image) }}" alt="Profile" class="profile-img"
                            id="profileImage">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($updateData->Username) }}&background=6a11cb&color=fff"
                            alt="Profile" class="profile-img" id="profileImage">
                    @endif

                    <form id="profileForm" method="POST" action="{{ route('save.account') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <label for="imageUpload" class="profile-img-overlay">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" id="imageUpload" name="image" accept="image/*" style="display: none;"
                            onchange="previewImage(event)">
                </div>

                <h2 class="profile-name">{{ $updateData->Username }}</h2>
            </div>


            <div class="section-title">Personal Information</div>

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="Username" class="form-control" value="{{ $updateData->Username }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ $updateData->email }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phone" class="form-control" value="{{ $updateData->Mobile }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Monthly Budget</label>
                <input type="number" name="budget" class="form-control" value="{{ $updateData->budget }}">
            </div>

            <button type="submit" class="btn btn-update">Update Profile</button>
            </form>
        </div>
    </div>
@endsection

@section('title')
    Update Profile - Expense Tracke
@endsection

@section('titleOfPageHead')
    Update Profile
@endsection

@section('csspart')
    <link rel="stylesheet" href="{{ asset('updateprofile.css') }}">
@endsection
