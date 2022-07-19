<x-auth :title="$title" :js="$js">

    <div class="account-box">
        <div class="account-wrapper">
            <h3 class="account-title">{{ $title ?? '' }}</h3>
            <p class="account-subtitle">{{ $description ?? '' }}</p>
            <form id="login-form">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-sm account-btn">Login</button>
                </div>
            </form>
        </div>
    </div>

</x-auth>
