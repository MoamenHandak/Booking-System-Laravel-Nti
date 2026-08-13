@extends('layouts.user')

@section('title', 'Create New Account')

@section('content')
<div class="container my-5 py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="card-header text-white text-center py-4 border-0"
                     style="background: linear-gradient(135deg, var(--accent-brown) 0%, var(--primary-rose) 100%);">

                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2 shadow-sm"
                         style="width: 60px; height: 60px; color: var(--primary-rose);">
                        <i class="fa-solid fa-user-plus fs-3"></i>
                    </div>

                    <h4
                        class="fw-bold mb-1"
                        data-i18n="register_title">
                        Create New Account
                    </h4>

                    <p
                        class="text-white-50 mb-0 small"
                        data-i18n="register_subtitle">
                        Join us and enjoy the best hotel deals
                    </p>
                </div>

                <div class="card-body p-4 p-md-5"
                     style="background-color: var(--card-bg);">

                    <form action="{{ url('/register') }}" method="POST" id="registerForm">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-3">

                            <label
                                class="form-label fw-bold small"
                                style="color: var(--text-color);"
                                data-i18n="full_name">
                                Full Name
                            </label>

                            <div class="input-group">

                                <span
                                    class="input-group-text border-end-0"
                                    style="background-color: var(--bg-main); color: var(--primary-rose);">
                                    <i class="fa-solid fa-user"></i>
                                </span>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control border-start-0 py-2"
                                    placeholder="Enter full name"
                                    data-i18n-placeholder="full_name_placeholder"
                                    required
                                    style="background-color: var(--bg-main); color: var(--text-color);">

                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">

                            <label
                                class="form-label fw-bold small"
                                style="color: var(--text-color);"
                                data-i18n="email">
                                Email Address
                            </label>

                            <div class="input-group">

                                <span
                                    class="input-group-text border-end-0"
                                    style="background-color: var(--bg-main); color: var(--primary-rose);">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control border-start-0 py-2"
                                    placeholder="Enter email address"
                                    data-i18n-placeholder="email_placeholder_register"
                                    required
                                    style="background-color: var(--bg-main); color: var(--text-color);">

                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">

                            <label
                                class="form-label fw-bold small"
                                style="color: var(--text-color);"
                                data-i18n="password">
                                Password
                            </label>

                            <div class="input-group">

                                <span
                                    class="input-group-text border-end-0"
                                    style="background-color: var(--bg-main); color: var(--primary-rose);">
                                    <i class="fa-solid fa-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control border-start-0 py-2"
                                    placeholder="Enter password"
                                    data-i18n-placeholder="password_placeholder_register"
                                    required
                                    style="background-color: var(--bg-main); color: var(--text-color);">

                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">

                            <label
                                class="form-label fw-bold small"
                                style="color: var(--text-color);"
                                data-i18n="confirm_password">
                                Confirm Password
                            </label>

                            <div class="input-group">

                                <span
                                    class="input-group-text border-end-0"
                                    style="background-color: var(--bg-main); color: var(--primary-rose);">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </span>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control border-start-0 py-2"
                                    placeholder="Confirm password"
                                    data-i18n-placeholder="confirm_password_placeholder"
                                    required
                                    style="background-color: var(--bg-main); color: var(--text-color);">

                            </div>
                        </div>

                        <!-- Register Button -->
                        <button
                            type="submit"
                            class="btn btn-rose btn-lg w-100 rounded-3 fw-bold mb-3"
                            style="font-size: 1.05rem; box-shadow: 0 4px 15px rgba(200, 138, 117, 0.35); border: 2px solid var(--primary-rose); transition: all 0.3s ease;"
                            onmouseover="this.style.boxShadow='0 8px 25px rgba(200, 138, 117, 0.55)'; this.style.transform='translateY(-3px) scale(1.02)';"
                            onmouseout="this.style.boxShadow='0 4px 15px rgba(200, 138, 117, 0.35)'; this.style.transform='translateY(0) scale(1)';">

                            <i class="fa-solid fa-user-check me-2"></i>

                            <span data-i18n="create_account_button">
                                Create Account
                            </span>

                        </button>

                        <!-- Sign In -->
                        <div class="text-center pt-2">

                            <span
                                class="text-muted small"
                                data-i18n="already_account">
                                Already have an account?
                            </span>

                            <a
                                href="{{ url('/login') }}"
                                class="fw-bold text-decoration-none small ms-1"
                                style="color: var(--primary-rose);"
                                data-i18n="sign_in">
                                Sign In
                            </a>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection