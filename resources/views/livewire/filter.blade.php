<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-12 flex flex-col sm:flex-row">
    <div class="p-6 bg-white border-b border-gray-200 w-full">
        <span class="italic text-sm">Location</span>
        <div class="w-full">
            <div>
                <input type="radio" name="location" id="location_goraya" value="goraya" wire:change="locationChanged('Goraya')">
                <label class="ml-2" for="location_goraya">Goraya</label>
            </div>

            <div>
                <input type="radio" name="location" id="location_nakodar" value="nakodar" wire:change="locationChanged('Nakodar')">
                <label class="ml-2" for="location_nakodar">Nakodar</label>
            </div>

            <div>
                <input type="radio" name="location" id="location_both" value="both" wire:change="locationChanged('')" checked>
                <label class="ml-2" for="location_both">Both</label>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white border-b border-gray-200 w-full">
        <span class="italic text-sm">Gender</span>
        <div class="w-full">
            <div>
                <input type="radio" name="gender" id="gender_male" value="male" wire:change="genderChanged('Male')">
                <label class="ml-2" for="gender_male">Male</label>
            </div>

            <div>
                <input type="radio" name="gender" id="gender_female" value="female" wire:change="genderChanged('Female')">
                <label class="ml-2" for="gender_female">Female</label>
            </div>

            <div>
                <input type="radio" name="gender" id="gender_both" value="both" wire:change="genderChanged('')" checked>
                <label class="ml-2" for="gender_both">Both</label>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white border-b border-gray-200 w-full">
        <span class="italic text-sm">Diet</span>
        <div class="w-full">
            <div>
                <input type="radio" name="diet" id="diet_veg" value="veg" wire:change="dietChanged('Vegetarian')">
                <label class="ml-2" for="diet_veg">Veg</label>
            </div>

            <div>
                <input type="radio" name="diet" id="diet_nonVeg" value="nonVeg" wire:change="dietChanged('Non-Vegetarian')">
                <label class="ml-2" for="diet_nonVeg">Non-Veg</label>
            </div>

            <div>
                <input type="radio" name="diet" id="diet_both" value="both" wire:change="dietChanged('')" checked>
                <label class="ml-2" for="diet_both">Both</label>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white border-b border-gray-200 w-full">
        <span class="italic text-sm">Action</span>
        <div class="w-full flex flex-col items-center space-y-2">
            <button wire:click="resetBtnClicked" class="w-full bg-gray-800 hover:bg-gray-700 text-white py-1 rounded-md">Reset</button>
            <button wire:click="filterBtnClicked" class="w-full bg-green-600 hover:bg-green-500 text-white py-1 rounded-md">Filter</button>
        </div>
    </div>
</div>
