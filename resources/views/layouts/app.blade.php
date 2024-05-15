<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <div id="notification-failure" class="hidden fixed bottom-0 z-50 bg-red-800 text-white text-lg font-bold text-center w-full py-2">
            This is a message
        </div>

        <div id="notification-success" class="hidden fixed bottom-0 z-40 bg-green-800 text-white text-lg font-bold text-center w-full py-2">
            This is a message
        </div>

        @livewireScripts
        <script>
            let selectedBoxes = [];
            let allSelectBoxesIds = [];

            window.onload = function() {
                Livewire.emit('showNotificationSuccess', 'Fetching data from API, Please wait...');
                Livewire.emit('ready');
                Livewire.emit('offersReady');
            }

            function selectAllBoxes(caller) {
                if (document.getElementById(caller).checked) {
                    allSelectBoxesIds.forEach((boxID) => {
                        selectedBoxes.push(boxID);
                        document.getElementById(boxID).checked = true;
                        document.getElementById('actionBar').classList.remove('hidden');
                    });
                } else {
                    selectedBoxes.forEach((boxID) => {
                        document.getElementById(boxID).checked = false;
                    });
                    selectedBoxes = [];
                    document.getElementById('actionBar').classList.add('hidden');
                    hideNotificationDialog();
                    hideOfferDialog();
                }
            }

            function checkboxHandler(caller) {
                if (document.getElementById(caller).checked) {
                    selectedBoxes.push(caller);
                    document.getElementById('actionBar').classList.remove('hidden');
                } else {
                    selectedBoxes.splice(selectedBoxes.indexOf(caller), 1);
                    if (selectedBoxes.length === 0) {
                        document.getElementById('actionBar').classList.add('hidden');
                        hideNotificationDialog();
                        hideOfferDialog();
                    }
                }
            }

            function clearOldOffers() {
                Livewire.emit('showNotificationSuccess', 'Clearing old offers, Please wait...');
                Livewire.emit('clearOffers', allSelectBoxesIds);
            }

            function previewNotificationUrl() {
                document.getElementById('notificationImage').src = document.getElementById('notificationUrl').value;
            }

            function previewOfferUrl() {
                document.getElementById('offerImage').src = document.getElementById('offerUrl').value;
            }

            function showNotificationDialog() {
                document.getElementById('notificationDialog').classList.remove('hidden');
                document.getElementById('notificationDialog').classList.add('flex');
                hideOfferDialog();
            }

            function hideNotificationDialog() {
                document.getElementById('notificationDialog').classList.add('hidden');
                document.getElementById('notificationDialog').classList.remove('flex');
            }

            function showOfferDialog() {
                document.getElementById('offerDialog').classList.remove('hidden');
                document.getElementById('offerDialog').classList.add('flex');
                hideNotificationDialog();
            }

            function hideOfferDialog() {
                document.getElementById('offerDialog').classList.add('hidden');
                document.getElementById('offerDialog').classList.remove('flex');
            }

            function showNotificationSuccess (message) {
                let notificationElement = document.getElementById('notification-success');
                notificationElement.innerText = message;
                notificationElement.classList.toggle('hidden');

                setTimeout( () => {
                    notificationElement.classList.toggle('hidden');
                }, 3000);
            }

            function showNotificationFailure (message) {
                let notificationElement = document.getElementById('notification-failure');
                notificationElement.innerText = message;
                notificationElement.classList.toggle('hidden');

                setTimeout(() => {
                    notificationElement.classList.toggle('hidden');
                }, 3000);
            }

            function sendNotification() {
                Livewire.emit('showNotificationSuccess', 'Sending notifications, Please wait...');
                let notificationObject = {
                    title: document.getElementById('notificationTitle').value,
                    body: document.getElementById('notificationBody').value,
                    url: document.getElementById('notificationUrl').value
                }
                Livewire.emit('sendNotificationsToUsers', notificationObject, selectedBoxes);
                Livewire.emit('unselectAll');
            }

            function sendOffer() {
                Livewire.emit('showNotificationSuccess', 'Sending offers, Please wait...');
                Livewire.emit('sendOffersToUsers', document.getElementById('offerUrl').value, selectedBoxes);
                Livewire.emit('unselectAll');
            }

            Livewire.on('showNotificationSuccess', (message) => {
                showNotificationSuccess(message);
            });

            Livewire.on('showNotificationFailure', (message) => {
                showNotificationFailure(message);
            });

            Livewire.on('fillOffers', (data) => {
                for (const dataKey in data) {
                    document.getElementById(data[dataKey]['offer']+'UrlInput').value = data[dataKey]['link'];
                }
            });

            Livewire.on('allKeys', (data) => {
                allSelectBoxesIds = data;
            });

            Livewire.on('resetSelectBoxes', () => {
                document.getElementById('location_both').checked = true;
                document.getElementById('gender_both').checked = true;
                document.getElementById('diet_both').checked = true;
                allSelectBoxesIds.forEach((boxID) => {
                    document.getElementById(boxID).checked = false;
                });
                selectedBoxes = [];
                document.getElementById('selectAllCheckBox').checked = false;
                document.getElementById('actionBar').classList.add('hidden');
            });

            Livewire.on('unselectAll', () => {
                if (selectedBoxes.length > 0) {
                    selectedBoxes.forEach((boxID) => {
                        document.getElementById(boxID).checked = false;
                    });
                }
                document.getElementById('selectAllCheckBox').checked = false;
                Livewire.emit('continueFilter');
            });

            function submitLink(caller) {
                let link = document.getElementById(caller+'UrlInput').value;
                let data = [caller, link];
                Livewire.emit('submitLink', data);
            }

            function syncLink(caller) {
                let link = document.getElementById(caller+'UrlInput').value;
                let data = [caller, link];
                Livewire.emit('syncLink', data);
                Livewire.emit('showNotificationSuccess', 'Updating daily offers, Please wait...');
            }
        </script>
    </body>
</html>
