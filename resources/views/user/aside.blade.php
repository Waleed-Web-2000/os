@php
    $id = Auth::user()->id ?? null; // Ensure `id` exists
    $user = $id ? App\Models\User::find($id) : null; // Use `find` for a cleaner approach
@endphp
<div class="page-content bg-light">
    <div class="dz-bnr-inr bg-lght">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>My Account</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">
                            {{ $user ? $user->name . ' Dashboard' : 'Guest Dashboard' }}
                        </li>
                    </ul>
                </nav>
            </div>
        </div>    
    </div>
</div>

		<div class="content-inner-1 bg-light">
			<div class="container">
                <div class="row">
					<aside class="col-xl-3">
						<div class="toggle-info"> 
							<h5 class="title mb-0">Account Navbar</h5>
							<a class="toggle-btn" href="#accountSidebar">Account Menu</a>
						</div>
						<div class="sticky-top account-sidebar-wrapper">
							<div class="account-sidebar" id="accountSidebar">
								<div class="profile-head">
									<div class="user-thumb">
										<img class="rounded-circle" src="/assets/images/profile4.jpg" alt="Susan Gardner">
									</div>
									<h5 class="title mb-0">{{ $user->name }}</h5>
									<span class="text text-primary">{{ $user->email }}</span>
								</div>
								<div class="account-nav">
									<div class="nav-title bg-secondary text-white">DASHBOARD</div>
									<ul>
										<li><a href="{{ route('user.index') }}">Dashboard <i class="fas fa-chart-line"></i></a></li> 
										<li><a href="{{ route('user.order') }}">Orders <i class="fas fa-box"></i></a></li>
										<li><a href="{{ route('user.payout') }}">Payout <i class="fas fa-money-check-alt"></i></a></li>
										<li><a href="{{ route('transaction.history', ['userId' => $user->id]) }}"> Transaction History <i class="fas fa-download"></i></a></li>
										<li><a href="{{ route('orders.history', ['userId' => $user->id]) }}"> Orders History <i class="fas fa-download"></i></a></li>
									</ul>
									<div class="nav-title bg-secondary text-white">ACCOUNT SETTINGS</div>
									<ul class="account-info-list">
										<li><a href="{{ route('user.profile') }}">Profile <i class="fas fa-user-circle"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
                    </aside>