<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Import Invoices
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form action="{{route('invoices.importStore')}}" method="POST" class="bg-white rounded p-8 shadow" enctype="multipart/form-data">
        @csrf
        <div>
          <h1 class="text-2xl font-semibold mb-4">Please, select the file you want to import</h1>
          <input type="file" name="file" accept=".csv, .xlsx">
          <x-jet-validation-errors class="mb-4"/>
          
        </div>
        <x-jet-button class="mt-4">
          Import File
        </x-jet-button>
      </form>
    </div>
  </div>
</x-app-layout>