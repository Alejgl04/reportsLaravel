<div>
  {{-- filters --}}
  <div class="bg-white rounded p-8 shadow mb-6">
    <h2 class="text-2xl font-semibold mb-4">Generate reports </h2>
    <div class="mb-4 mobile-select-filter float-right">
      Serie:
      <select wire:model="filters.serie" name="serie" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-32">
        <option value="">All</option>
        <option value="F001">F001</option>
        <option value="B001">B001</option>
      </select>
    </div>

    <div class="flex space-x-4 mb-4">
      <div>
        From Number:
        <x-jet-input wire:model="filters.fromNumber" type="text" class="w-20" />
      </div>
      <div>
        To Number:
        <x-jet-input wire:model="filters.toNumber" type="text" class="w-20" />
        
      </div>
    </div>

    <div class="flex space-x-4 mb-4">
      <div>
        From Date:
        <x-jet-input wire:model="filters.fromDate" type="date" class="w-36" />
      </div>
      <div>
        To Date:
        <x-jet-input wire:model="filters.toDate" type="date" class="w-36" />
        
      </div>
    </div>
    <x-jet-button wire:click="generateReport">
      <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
      Excel Report
    </x-jet-button>
    <x-jet-button wire:click="">
      <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
      PDF Report
    </x-jet-button>
  </div>

  {{-- Table Data --}}
  <div class="overflow-x-auto relative">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="py-3 px-6">
            ID
          </th>
          <th scope="col" class="py-3 px-6">
            Serie
          </th>
          <th scope="col" class="py-3 px-6">
            Correlative
          </th>
          <th scope="col" class="py-3 px-6">
            Base
          </th>
          <th scope="col" class="py-3 px-6">
            TAX
          </th>
          <th scope="col" class="py-3 px-6">
            Total
          </th>
          <th scope="col" class="py-3 px-6">
            Date
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($invoices as $invoice)
            
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $invoice->id }}
            </th>
            <td class="py-4 px-6">
              {{ $invoice->serie }}
            </td>
            <td class="py-4 px-6">
              {{ $invoice->correlative }}
            </td>
            <td class="py-4 px-6">
              <strong>$</strong> {{ $invoice->base }}
            </td>
            <td class="py-4 px-6">
              <strong>$</strong> {{ $invoice->tax }}
            </td>
            <td class="py-4 px-6">
              <strong>$</strong> {{ $invoice->total }}
            </td>
            <td class="py-4 px-6">
              {{ $invoice->created_at->format("m/d/Y") }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  <div class="mt-4">
    {{ $invoices->links() }}
  </div>
</div>
