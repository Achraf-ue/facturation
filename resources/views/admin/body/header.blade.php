
<?php
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
$Count = Notification::where('Lire_notification','=','0')->count();
$Notifications = Notification::where('Lire_notification','=','0')->get();
//$Count = DB::select('select count(*) from users')
//$Count = 3;
?>
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="index.html" class="logo">
            <span>
                    <img src="assets/images/logo-light.png" alt="" height="18">
                </span>
            <i>
                    <img src="assets/images/logo-sm.png" alt="" height="22">
                </i>
        </a>
    </div>

    <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">
            

            <!-- language-->
            <!-- full screen -->
            

            <!-- notification -->
            <li class="dropdown notification-list list-inline-item">
                <a id="Notification" class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="badge badge-pill badge-danger noti-icon-badge" id='Notification_Count'>{{$Count}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                    <!-- item-->
                    <h6 style="text-align: center" class="dropdown-item-text">
                            Notifications ({{$Count}})
                        </h6>
                    <div class="slimscroll notification-item-list">
                        @foreach ( $Notifications as  $Notification)
                            <a href="{{route('Modifier_facture',$Notification->id_fature)}}" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                            <p class="notify-details">{{$Notification->Titre}}<span class="text-muted">{{$Notification->Notifiaction}}</span></p>
                            </a>
                        @endforeach
                        
                    </div>
                    <!-- All-->
                <!--    <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                            View all <i class="fi-arrow-right"></i>
                        </a>  -->
                </div>
            </li>
            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('backend/assets/images/users/user-4.jpg')}}" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                        <a class="dropdown-item text-danger" href="{{route('admin.logout')}}"><i class="mdi mdi-power text-danger"></i> Logout</a>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        <!--    <li class="d-none d-sm-block">
                <div class="dropdown pt-3 d-inline-block">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Create
                        </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </li>  -->
        </ul>

    </nav>

</div>
