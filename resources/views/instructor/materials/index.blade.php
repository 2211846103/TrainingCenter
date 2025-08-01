@extends('layouts.dashboard')

@section('title', 'Manage Course Materials')

@section('breadcrumbs')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">Manage Materials</span>
@endsection

@section('toolbar-actions')
    <button id="open-modal" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
        + Add New Material
    </button>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-medium text-[#48465b]">Materials for: {{ $course->title }}</h2>
    </div>

    <div id="materials-list" class="divide-y divide-gray-200"></div>
</div>

<div id="material-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] w-full max-w-lg">
        
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-medium text-[#48465b]">Add New Material</h2>
            <button id="cancel-modal-header" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-8">
            <div class="space-y-6">
                <div>
                    <label for="material-name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input id="material-name" type="text" placeholder="e.g., Introduction to CSS" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" />
                </div>

                <div>
                    <label for="material-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="material-description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="material-type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select id="material-type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="video">Video</option>
                            <option value="document">Document</option>
                            <option value="image">Image</option>
                        </select>
                    </div>

                     <div>
                        <label for="material-length" class="block text-sm font-medium text-gray-700 mb-1">Length (seconds)</label>
                        <input id="material-length" type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="For video only" />
                    </div>
                </div>

                <div>
                    <label for="material-file" class="block text-sm font-medium text-gray-700 mb-1">File</label>
                    <input id="material-file" type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                </div>
            </div>
        </div>

        <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-200 flex justify-end items-center space-x-4">
            <button id="cancel-modal-footer" class="text-sm font-medium text-gray-600 hover:text-gray-800">Cancel</button>
            <button id="submit-material" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Add Material</button>
        </div>
    </div>
</div>

<div id="edit-material-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
  <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] w-full max-w-lg">
    
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
      <h2 class="text-lg font-medium text-[#48465b]">Edit Material</h2>
      <button id="close-edit-modal" class="text-gray-400 hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <div class="p-8 space-y-6">
      <input type="hidden" id="edit-index" />

      <div>
        <label for="edit-material-name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input id="edit-material-name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600" />
      </div>

      <div>
        <label for="edit-material-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea id="edit-material-description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600"></textarea>
      </div>

      <div class="grid grid-cols-2 gap-6">
        <div>
          <label for="edit-material-type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
          <select id="edit-material-type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600">
            <option value="video">Video</option>
            <option value="document">Document</option>
            <option value="image">Image</option>
          </select>
        </div>
        <div>
          <label for="edit-material-length" class="block text-sm font-medium text-gray-700 mb-1">Length (seconds)</label>
          <input id="edit-material-length" type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600" />
        </div>
      </div>

      <div>
        <label for="edit-material-file" class="block text-sm font-medium text-gray-700 mb-1">File (leave empty to keep existing)</label>
        <input id="edit-material-file" type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
      </div>
    </div>

    <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-200 flex justify-end space-x-4">
      <button id="cancel-edit-modal" class="text-sm font-medium text-gray-600 hover:text-gray-800">Cancel</button>
      <button id="save-edit-material" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save Changes</button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    let materials = @json($materials);
    const list = document.getElementById('materials-list');

    const openBtn = document.getElementById('open-modal');
    const modal = document.getElementById('material-modal');
    const cancelBtnHeader = document.getElementById('cancel-modal-header');
    const cancelBtnFooter = document.getElementById('cancel-modal-footer');
    const submitBtn = document.getElementById('submit-material');

    openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    cancelBtnHeader.addEventListener('click', () => modal.classList.add('hidden'));
    cancelBtnFooter.addEventListener('click', () => modal.classList.add('hidden'));

    submitBtn.addEventListener('click', async () => {
      const name = document.getElementById('material-name').value;
      const description = document.getElementById('material-description').value;
      const type = document.getElementById('material-type').value;
      const fileInput = document.getElementById('material-file');
      const length_in_sec = parseInt(document.getElementById('material-length').value) || 0;

      if (!name || !fileInput.files.length) {
        alert("Name and file are required.");
        return;
      }

      const formData = new FormData();
      formData.append('name', name);
      formData.append('description', description);
      formData.append('type', type);
      formData.append('length_in_sec', length_in_sec);
      formData.append('file', fileInput.files[0]);

      const res = await fetch('{{ route('materials.store', $course) }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
      });

      const result = await res.json();
      if (res.ok) {
        addMaterial(result);
        modal.classList.add('hidden');
      } else {
        alert("Upload failed");
        console.error(result);
      }
    });

    function formatDuration(seconds) {
      const hrs = Math.floor(seconds / 3600);
      const mins = Math.floor((seconds % 3600) / 60);
      const secs = seconds % 60;
  
      const parts = [];
      if (hrs > 0) parts.push(`${hrs} hour${hrs !== 1 ? 's' : ''}`);
      if (mins > 0) parts.push(`${mins} minute${mins !== 1 ? 's' : ''}`);
      if (secs > 0 || parts.length === 0) parts.push(`${secs} second${secs !== 1 ? 's' : ''}`);
  
      return parts.join(' ');
    }
  
    function renderMaterials() {
      list.innerHTML = '';
  
      materials.forEach((m, index) => {
        const item = document.createElement('div');
        item.className = 'flex items-center p-4';
        item.dataset.id = m.id ?? `temp-${index}`;
  
        item.innerHTML = `
          <div class="drag-handle cursor-grab text-gray-400 hover:text-gray-600 pr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
          </div>
          <span class="font-bold text-gray-500 w-8 order-number">${index + 1}.</span>
          <div class="flex-grow">
            <div class="font-medium text-gray-800">${m.name}</div>
            <div class="text-xs text-gray-500">
                ${m.type.charAt(0).toUpperCase() + m.type.slice(1)} - 
                ${m.type === 'video' ? formatDuration(m.length_in_sec) : m.extension.toUpperCase()}
            </div>
          </div>
          <div class="space-x-2 flex align-center">
            <a href="#" class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200 edit-btn">Edit</a>
            <button class="cursor-pointer px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-md hover:bg-red-200 delete-btn">Delete</button>
          </div>
        `;
  
        list.appendChild(item);
      });
  
      attachDeleteHandlers();
      attachEditHandlers();
    }
  
    function attachDeleteHandlers() {
      document.querySelectorAll('.delete-btn').forEach((btn, i) => {
        btn.addEventListener('click', () => {
          materials.splice(i, 1);
          renderMaterials();
          syncMaterialsToBackend();
        });
      });
    }

    function attachEditHandlers() {
      document.querySelectorAll('.edit-btn').forEach((btn, i) => {
        btn.addEventListener('click', () => {
          const m = materials[i];

          document.getElementById('edit-index').value = i;
          document.getElementById('edit-material-name').value = m.name;
          document.getElementById('edit-material-description').value = m.description;
          document.getElementById('edit-material-type').value = m.type;
          document.getElementById('edit-material-length').value = m.length_in_sec;

          document.getElementById('edit-material-modal').classList.remove('hidden');
        });
      });
    }
  
    function addMaterial(materialData) {
      materials.push(materialData);
      renderMaterials();
      syncMaterialsToBackend();
    }
  
    async function syncMaterialsToBackend() {
      fetch('{{ route('materials.relist', $course) }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ materials })
      })
      .then(res => res.json())
      .then(data => console.log('Synced!', data))
      .catch(err => console.error('Sync error:', err));
    }

    renderMaterials();
  
    new Sortable(list, {
      animation: 150,
      handle: '.drag-handle',
      onEnd: function (evt) {
        const movedItem = materials.splice(evt.oldIndex, 1)[0];
        materials.splice(evt.newIndex, 0, movedItem);
        renderMaterials();
        syncMaterialsToBackend();
      }
    });

    document.getElementById('save-edit-material').addEventListener('click', () => {
      const index = parseInt(document.getElementById('edit-index').value);
      const name = document.getElementById('edit-material-name').value;
      const description = document.getElementById('edit-material-description').value;
      const type = document.getElementById('edit-material-type').value;
      const length_in_sec = parseInt(document.getElementById('edit-material-length').value) || 0;
      const fileInput = document.getElementById('edit-material-file');
      const file = fileInput.value;

      const material = materials[index];
      material.name = name;
      material.description = description;
      material.type = type;
      material.length_in_sec = length_in_sec;

      if (file) {
        material.file_path = file;
        material.extension = file.split('.').pop();
      }

      renderMaterials();
      syncMaterialsToBackend();
      document.getElementById('edit-material-modal').classList.add('hidden');
    });

    document.getElementById('cancel-edit-modal').addEventListener('click', () => {
      document.getElementById('edit-material-modal').classList.add('hidden');
    });

    document.getElementById('close-edit-modal').addEventListener('click', () => {
      document.getElementById('edit-material-modal').classList.add('hidden');
    });
  });

</script>
@endpush

@endsection