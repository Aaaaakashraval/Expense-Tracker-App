@extends('main')

@section('title')
    User Profile - Expense Tracker
@endsection

@section('csspart')
    <link rel="stylesheet" href="{{ asset('myaccount.css') }}">
@endsection

@section('titleOfPageHead')
    My Profile
@endsection

@section('mainpart')
    <!-- Profile Content -->
    <div class="profile-container">
        <!-- Personal Details Card -->
        <div class="profile-card">
            <div class="profile-header">

                @if ($user->image)
                    <img src="{{ asset('uploads/profile/' . $user->image) }}" alt="Profile" class="profile-img"
                        id="profileImage">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->Username) }}&background=6a11cb&color=fff"
                        alt="Profile" class="profile-img" id="profileImage">
                @endif


                <h2 class="profile-name" style="text-transform: capitalize;"> {{ $user->Username }}</h2>
                <p class="profile-email">{{ $user->email }}</p>

                <div class="row" style="margin-left: 10%">
                    <div class="col-6">
                        <a href="{{ route('updateaccountETA') }}" style="text-decoration: none" class="edit-btn">Edit
                            Profile</a>
                    </div>
                    <div class="col-4">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn edit-btn">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="section-title">Personal Information</div>

            <div class="detail-item">
                <span class="detail-label">Full Name</span>
                <span class="detail-value">{{ $user->Username }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Phone</span>
                <span class="detail-value">{{ $user->Mobile ?? 'Not Provided' }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Member Since</span>
                <span class="detail-value">{{ $user->created_at->format('F Y') }}</span>
            </div>
        </div>

        <!-- Financial Overview Card -->
        <div class="profile-card">
            <div class="section-title">Financial Overview</div>

            <div class="financial-stats">
                <div class="stat-card">
                    <div class="stat-value">₹{{ number_format($monthlyBudget, 2) }}</div>
                    <div class="stat-label">Monthly Budget</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">₹{{ number_format($monthlySpending, 2) }}</div>
                    <div class="stat-label">Monthly Spending</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">₹{{ number_format($remaining, 2) }}</div>
                    <div class="stat-label">Remaining</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">{{ $expenseCount }}</div>
                    <div class="stat-label">Expenses This Month</div>
                </div>
            </div>
        </div>
    </div>
@endsection
