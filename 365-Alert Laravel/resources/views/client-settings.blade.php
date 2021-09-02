{{-- Extending the template --}}
@extends('layouts.mytemplate')

{{-- Setting the Page title --}}
@section('title', 'Client Settings')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/client-settings.css') }}">
@endsection
{{-- Main Content Section --}}
@section('content')
    <main>

        <body>


            <img src="{{ URL::asset('../css/logos/User_WhiteStroke_Circle.svg') }}" alt="">
            <h1 id="client">Client Settings</h1>

            <section id="settings-bar">
                <h2>Personal Details</h2>
            </section>

            <section id="user-details">
                <div class="user-username">
                    <h2>Username</h2>
                    <p>

                    </p>
                </div>
                <div class="user-email">
                    <h2>Email</h2>
                    <p>

                    </p>
                </div>
                <div class="user-phone">
                    <h2>Phone</h2>
                    <p>

                    </p>
                </div>

                <div id="change-buttons">
                    <div class="red-buttons">
                        <button type="submit">Change Username</button>
                        <button type="submit">Change Email</button>
                        <button type="submit">Change Phone</button>
                    </div>
                </div>
                </div>

            </section>
            <section id="settings-bar">
                <h2>Change Password</h2>
            </section>
            <section id="change-password">
                <form action="sumbit">
                    <label for="current_password">Current Password</label> <br>
                    <input type="text" name="current_password" id="" placeholder="Enter Current Password"> <br>

                    <label for="new_password">New Password</label> <br>
                    <input type="text" name="new_password" id="" placeholder="Enter New Password"> <br>

                    <label for="confirm_password">Current Password</label> <br>
                    <input type="text" name="confirm_password" id="" placeholder="Confirm New Password"> <br>

                    <input id="subbutton" type="submit">


                </form>
            </section>
            <section id="settings-bar">
                <h2>Alert Notifications</h2>
            </section>

            <section id="user-details">
                <div class="user-username">
                    <h2>Favorites</h2>
                </div>
                <div class="user-email">
                    <h2>Add New Region</h2>
                    <select name="regions" id="">
                        <option value="Region1"></option>
                        <option value="Region2"></option>
                        <option value="Region3"></option>
                    </select>
                </div>
            </section>
            <section id="settings-bar">
                <h2>Unsubscribe</h2>

            </section>
            <section id="user-details">
                <input id="cbox" type="checkbox">
                <p id="cbox">Lmao box gang</p>
            </section>
        </body>
    </main>
@endsection
