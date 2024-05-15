<div class="my-12">
    <div class="text-right mx-2" :wire:key="otherButtons">
        <button class="my-2 px-2 py-1 text-white font-bold text-xs rounded-md bg-gray-800 hover:bg-gray-700" onclick="clearOldOffers()">Clear Offers</button>
        <a class="my-2 px-2 py-1 text-white font-bold text-xs rounded-md bg-green-600 hover:bg-green-500" target="_blank" href="/console/exportdb">Export DB</a>
    </div>
    <div class="bg-white shadow-sm sm:rounded-lg flex flex-col break-words relative" :wire:key="headerRow">
        <div class="flex flex-row rounded-t-lg bg-white border-b border-gray-200 w-full p-4 items-center sticky top-0">
            <span class="mx-2" style="width: 5%;"><input type="checkbox" id="selectAllCheckBox" class="rounded" onchange="selectAllBoxes(this.id)"></span>
            <h1 style="width: 5%;" class="mx-2 font-bold break-normal">ID</h1>
            <h1 style="width: 25%;" class="mx-2 font-bold">Name</h1>
            <h1 style="width: 25%;" class="mx-2 font-bold">Phone</h1>
            <h1 style="width: 40%;" class="mx-2 font-bold">Details (Location | Gender | Diet)</h1>
        </div>

        <div id="actionBar" class="hidden flex flex-row bg-white border-b border-gray-200 p-2 w-full items-center space-x-2" :wire:key="actionBar">
            <button class="bg-yellow-100 hover:bg-yellow-200 rounded-md w-full p-2 font-bold" onclick="showNotificationDialog()">Send Notification</button>
            <button class="bg-blue-50 hover:bg-blue-100 rounded-md w-full p-2 font-bold" onclick="showOfferDialog()">Send Offer</button>
        </div>

        <div id="notificationDialog" class="hidden flex flex-row bg-white border-b border-gray-200 p-2 w-full justify-between items-center space-x-1" :wire:key="notificationDialog">
            <div class="flex flex-col w-full justify-center items-center mx-2 space-y-2">
                <input id="notificationTitle" placeholder="Notification Title" type="text" class="font-medium w-full px-2 py-0.5 border border-gray-300 rounded focus:border-none focus:outline-none">
                <input id="notificationBody" placeholder="Notification Body" type="text" class="font-medium w-full px-2 py-0.5 border border-gray-300 rounded focus:border-none focus:outline-none">
                <input id="notificationUrl" placeholder="https://image.url" type="text" class="font-medium w-full px-2 py-0.5 border border-gray-300 rounded focus:border-none focus:outline-none">
            </div>
            <div class="p-2 w-28 h-auto border border-gray-300 rounded">
                <img id="notificationImage" src="https://figos.in/wp-content/uploads/2020/09/flogo-1.png">
            </div>
            <div class="p-2 h-full space-y-2">
                <button class="bg-gray-200 xl:hover:bg-gray-100 px-2 py-1 rounded-md w-full" onclick="hideNotificationDialog()">Close</button>
                <button class="bg-gray-800 xl:hover:bg-gray-700 px-2 py-1 text-white rounded-md w-full" onclick="previewNotificationUrl()">Preview</button>
                <button class="bg-green-600 xl:hover:bg-green-500 px-2 py-1 text-white rounded-md w-full" onclick="sendNotification()">Notify</button>
            </div>
        </div>

        <div id="offerDialog" class="hidden flex flex-col bg-white border-b border-gray-200 p-2 w-full space-y-2" :wire:key="offerDialog">
            <div class="flex justify-center p-2 w-full">
                <img class="w-28 h-auto border border-gray-300 rounded" id="offerImage" src="https://figos.in/wp-content/uploads/2020/09/flogo-1.png">
            </div>
            <div class="flex flex-col sm:flex-row p-2 space-y-2 space-x-0 sm:space-y-0 sm:space-x-2 w-full">
                <input id="offerUrl" placeholder="https://image.url" type="text" class="font-medium w-full px-2 py-0.5 border border-gray-300 rounded focus:border-none focus:outline-none">
                <button class="bg-gray-200 xl:hover:bg-gray-100 px-2 py-1 rounded-md w-auto" onclick="hideOfferDialog()">Close</button>
                <button class="bg-gray-800 xl:hover:bg-gray-700 px-2 py-1 text-white rounded-md w-auto" onclick="previewOfferUrl()">Preview</button>
                <button class="bg-green-600 xl:hover:bg-green-500 px-2 py-1 text-white rounded-md w-auto" onclick="sendOffer()">Send</button>
            </div>
        </div>

        @if($data !== null)
            @foreach($data as $datum)
                <div class="flex flex-row bg-white border-b border-gray-200 w-full p-4 items-center hover:bg-gray-50" :wire:key="{{ $datum[0] }}">
                    <span class="mx-2" style="width: 5%;"><input type="checkbox" id="{{ $datum[0] }}" class="rounded" onchange="checkboxHandler(this.id)"></span>
                    <h1 style="width: 5%;" class="mx-2 break-normal">{{ $loop->iteration }}</h1>
                    <h1 style="width: 25%;" class="mx-2">{{ $datum[1]["name"] }}</h1>
                    <h1 style="width: 25%;" class="mx-2">{{ $datum[1]["phone"] }}</h1>
                    <h1 style="width: 40%;" class="mx-2">{{ $datum[1]["location"]." | ".$datum[1]["gender"]." | ".$datum[1]["diet"] }}</h1>
                </div>
            @endforeach
        @endif
        <div class="flex flex-row rounded-b-lg bg-white w-full p-4 items-center h-4"></div>
    </div>
</div>
