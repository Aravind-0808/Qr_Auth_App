<h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 text-center mb-4">
    Welcome, {{ auth()->user()->name }}!
</h1>
<p class="text-center text-gray-600 dark:text-gray-400 mb-6">
    Your personalized QR code is generated below.
</p>
   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 text-gray-900 dark:text-gray-100">
                   <div class="my-4">
                       <div class="inline-block border border-gray-300 rounded p-4 bg-gray-50">
                           {!! $qrCode !!}
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
