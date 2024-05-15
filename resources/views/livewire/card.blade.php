<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-12 flex flex-col lg:flex-row">
    <div class="p-6 bg-white border-b border-gray-200 w-full">
        <span class="italic text-sm">Goraya</span>
        <div class="w-full">
            <h1 id="gorayaCount" class="text-gray-900 text-4xl">{{ $gorayaCount }}</h1>
            <h2 id="gorayaGender">Male: <span class="font-bold">{{ $gorayaMale }}</span> | Female: <span class="font-bold">{{ $gorayaFemale }}</span></h2>
            <h2 id="gorayaDiet">Veg: <span class="font-bold">{{ $gorayaVeg }}</span> | Non-Veg: <span class="font-bold">{{ $gorayaNonVeg }}</span></h2>
        </div>
    </div>

    <div class="p-6 bg-white border-b border-gray-200 w-full">
        <span class="italic text-sm">Nakodar</span>
        <div class="w-full">
            <h1 id="nakodarCount" class="text-gray-900 text-4xl">{{ $nakodarCount }}</h1>
            <h2 id="nakodarGender">Male: <span class="font-bold">{{ $nakodarMale }}</span> | Female: <span class="font-bold">{{ $nakodarFemale }}</span></h2>
            <h2 id="nakodarDiet">Veg: <span class="font-bold">{{ $nakodarVeg }}</span> | Non-Veg: <span class="font-bold">{{ $nakodarNonVeg }}</span></h2>
        </div>
    </div>

    <div class="p-6 bg-white border-b border-gray-200 w-full">
        <span class="italic text-sm">Total</span>
        <div class="w-full">
            <h1 id="totalCount" class="text-gray-900 text-4xl">{{ $gorayaCount + $nakodarCount }}</h1>
            <h2 id="totalGender">Male: <span class="font-bold">{{ $gorayaMale + $nakodarMale }}</span> | Female: <span class="font-bold">{{ $gorayaFemale + $nakodarFemale }}</span></h2>
            <h2 id="totalDiet">Veg: <span class="font-bold">{{ $gorayaVeg + $nakodarVeg }}</span> | Non-Veg: <span class="font-bold">{{ $gorayaNonVeg + $nakodarNonVeg }}</span></h2>
        </div>
    </div>
</div>
