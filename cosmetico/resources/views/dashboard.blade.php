<x-public-layout>
    <div class="pt-32 pb-24 min-h-screen bg-stone-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-stone-900 font-serif">Mi Panel</h1>
                <p class="text-lg text-stone-600 mt-2">Bienvenido, {{ auth()->user()->name }}. Administra tus reservas desde aquí.</p>
            </div>

            @if(session('success'))
                <div class="p-4 mb-6 text-sm text-green-800 rounded-2xl bg-green-50 border border-green-200 shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(request('verified') == '1')
                <div class="p-4 mb-6 text-sm text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-200 shadow-sm flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <strong class="font-bold block text-emerald-900">¡Verificación completada!</strong>
                        Tu correo ha sido verificado correctamente. ¡Ya estás listo para agendar tu primera cita con nosotros!
                    </div>
                </div>
            @endif

            @if(auth()->user()->is_admin)
                <!-- Admin Dashboard -->
                <div class="bg-white rounded-3xl shadow-xl border border-stone-100 overflow-hidden">
                    <div class="p-8 border-b border-stone-100 bg-gradient-to-r from-rose-50 to-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-stone-900 font-serif">Administración de Citas</h3>
                            <p class="text-stone-500 mt-1">Gestiona todas las reservas de los clientes.</p>
                        </div>
                        <span id="selected-count" class="hidden text-sm font-semibold text-rose-600 bg-rose-50 border border-rose-200 rounded-full px-4 py-1.5">
                            <span id="selected-num">0</span> seleccionada(s)
                        </span>
                    </div>

                    {{-- Bulk Action Bar --}}
                    <div id="bulk-bar" class="hidden bg-stone-900 text-white px-8 py-4 flex flex-wrap gap-3 items-center">
                        <span class="text-sm font-medium mr-2">Acción masiva:</span>

                        {{-- Bulk Status --}}
                        <form id="bulk-status-form" action="{{ route('appointments.bulk-status') }}" method="POST" class="flex gap-2 items-center">
                            @csrf
                            <div id="bulk-ids-status"></div>
                            <select name="status" class="text-sm rounded-xl border-0 bg-white text-stone-900 shadow-sm focus:ring-2 focus:ring-rose-400 h-9 px-3">
                                <option value="pending">Pendiente</option>
                                <option value="confirmed">Confirmada</option>
                                <option value="cancelled">Cancelada</option>
                            </select>
                            <button type="submit" class="h-9 px-4 rounded-xl bg-white text-stone-900 text-xs font-bold hover:bg-stone-100 transition-colors">
                                Cambiar estado
                            </button>
                        </form>

                        <div class="w-px h-6 bg-stone-700 mx-1"></div>

                        {{-- Bulk Delete --}}
                        <form id="bulk-delete-form" action="{{ route('appointments.bulk-delete') }}" method="POST" class="flex gap-2 items-center" onsubmit="return confirm('¿Eliminar las citas seleccionadas? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <div id="bulk-ids-delete"></div>
                            <button type="submit" class="h-9 px-4 rounded-xl bg-red-600 text-white text-xs font-bold hover:bg-red-700 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Eliminar seleccionadas
                            </button>
                        </form>

                        <button onclick="clearSelection()" class="ml-auto h-9 px-4 rounded-xl border border-stone-600 text-stone-300 text-xs font-medium hover:bg-stone-800 transition-colors">
                            Cancelar
                        </button>
                    </div>

                    <div class="overflow-x-auto p-8">
                        <table class="min-w-full divide-y divide-stone-200" id="admin-table">
                            <thead>
                                <tr>
                                    <th class="px-4 py-4 text-left">
                                        <input type="checkbox" id="select-all" class="rounded border-stone-300 text-rose-600 shadow-sm focus:ring-rose-500 cursor-pointer w-4 h-4">
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Cliente</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Servicio</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Fecha y Hora</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Estado</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Acción Individual</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                @forelse($appointments as $appointment)
                                    <tr class="hover:bg-stone-50 transition-colors appointment-row" data-id="{{ $appointment->id }}">
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <input type="checkbox" class="row-checkbox rounded border-stone-300 text-rose-600 shadow-sm focus:ring-rose-500 cursor-pointer w-4 h-4" value="{{ $appointment->id }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-stone-900">{{ $appointment->user->name }}</div>
                                            <div class="text-xs text-stone-500 mt-1">{{ $appointment->user->email }}</div>
                                            <div class="text-xs text-rose-600 font-medium mt-0.5">{{ $appointment->user->phone }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-700 font-medium">{{ $appointment->service }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                            <div class="font-medium text-stone-900">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</div>
                                            <div class="text-stone-500">{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }} hrs</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $appointment->status == 'pending'   ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : '' }}
                                                {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800 border border-green-200'   : '' }}
                                                {{ $appointment->status == 'cancelled' ? 'bg-red-100 text-red-800 border border-red-200'         : '' }}">
                                                {{ $appointment->status == 'pending' ? 'Pendiente' : ($appointment->status == 'confirmed' ? 'Confirmada' : 'Cancelada') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">
                                            <form action="{{ route('appointments.update', $appointment) }}" method="POST" class="flex gap-2 items-center">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="text-sm rounded-xl border-stone-300 shadow-sm focus:border-rose-300 focus:ring focus:ring-rose-200 focus:ring-opacity-50 bg-white">
                                                    <option value="pending"   {{ $appointment->status == 'pending'   ? 'selected' : '' }}>Pendiente</option>
                                                    <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmada</option>
                                                    <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                                                </select>
                                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-xs font-semibold text-white bg-stone-900 hover:bg-stone-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-900 transition-colors">
                                                    Guardar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                                            <svg class="mx-auto h-12 w-12 text-stone-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            No hay citas agendadas en el sistema.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <!-- User Dashboard -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Column: Agendar Form -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-3xl shadow-xl border border-stone-100 overflow-hidden sticky top-32">
                            <div class="p-8 border-b border-stone-100 bg-gradient-to-br from-rose-50 to-white">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-rose-500 shadow-sm mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-stone-900 font-serif">Agendar Nueva Cita</h3>
                                <p class="text-sm text-stone-500 mt-2">Selecciona tu servicio y horario ideal.</p>
                            </div>
                            
                            <div class="p-8 bg-white">
                                <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
                                    @csrf

                                    @if($errors->any())
                                        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-sm text-red-700 space-y-1">
                                            @foreach($errors->all() as $error)
                                                <p class="flex items-start gap-2"><svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div>
                                        <label for="service" class="block text-sm font-bold text-stone-700 mb-2">Servicio Especializado</label>
                                        <select name="service" id="service" required class="block w-full h-12 rounded-2xl border-stone-200 shadow-sm focus:border-rose-400 focus:ring focus:ring-rose-200 focus:ring-opacity-50 transition-colors bg-stone-50 hover:bg-white text-stone-800">
                                            <option value="">Selecciona un servicio</option>
                                            <option value="Limpieza Básica" {{ request('service') == 'Limpieza Básica' ? 'selected' : '' }}>Limpieza Básica</option>
                                            <option value="Limpieza con Peeling" {{ request('service') == 'Limpieza con Peeling' ? 'selected' : '' }}>Limpieza con Peeling</option>
                                            <option value="Limpieza Profunda" {{ request('service') == 'Limpieza Profunda' ? 'selected' : '' }}>Limpieza Profunda</option>
                                            <option value="Tratamiento Nutritivo" {{ request('service') == 'Tratamiento Nutritivo' ? 'selected' : '' }}>Tratamiento Nutritivo</option>
                                            <option value="Nutritivo + Masaje Cráneo Facial" {{ request('service') == 'Nutritivo + Masaje Cráneo Facial' ? 'selected' : '' }}>Nutritivo + Masaje Cráneo Facial</option>
                                            <option value="Masaje Cráneo Facial" {{ request('service') == 'Masaje Cráneo Facial' ? 'selected' : '' }}>Masaje Cráneo Facial</option>
                                            <option value="Espalda y Cuello" {{ request('service') == 'Espalda y Cuello' ? 'selected' : '' }}>Espalda y Cuello</option>
                                            <option value="Cuerpo Completo" {{ request('service') == 'Cuerpo Completo' ? 'selected' : '' }}>Cuerpo Completo</option>
                                            <option value="Masaje con Piedras Calientes" {{ request('service') == 'Masaje con Piedras Calientes' ? 'selected' : '' }}>Masaje con Piedras Calientes</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="date" class="block text-sm font-bold text-stone-700 mb-2">Fecha <span class="text-xs font-normal text-stone-500">(desde mañana)</span></label>
                                        <input type="date" name="date" id="date" required
                                            min="{{ now()->addDay()->format('Y-m-d') }}"
                                            value="{{ old('date') }}"
                                            class="block w-full h-12 rounded-2xl border-stone-200 shadow-sm focus:border-rose-400 focus:ring focus:ring-rose-200 focus:ring-opacity-50 transition-colors bg-stone-50 hover:bg-white text-stone-800">
                                    </div>

                                    <div>
                                        <label for="time" class="block text-sm font-bold text-stone-700 mb-2">Hora</label>
                                        <select name="time" id="time" required class="block w-full h-12 rounded-2xl border-stone-200 shadow-sm focus:border-rose-400 focus:ring focus:ring-rose-200 focus:ring-opacity-50 transition-colors bg-stone-50 hover:bg-white text-stone-800">
                                            <option value="" disabled selected>Elige</option>
                                            <option value="10:00">10:00 AM</option>
                                            <option value="11:00">11:00 AM</option>
                                            <option value="12:00">12:00 PM</option>
                                            <option value="13:00">01:00 PM</option>
                                            <option value="15:00">03:00 PM</option>
                                            <option value="16:00">04:00 PM</option>
                                            <option value="17:00">05:00 PM</option>
                                            <option value="18:00">06:00 PM</option>
                                        </select>
                                    </div>

                                    <div class="rounded-2xl bg-amber-50 border border-amber-200 p-4 text-xs text-amber-800 flex gap-2">
                                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        <span>Las reservas se realizan con <strong>al menos un día de anticipación</strong>. Si necesitas atención urgente, llámanos al <strong>+56 9 1234 5678</strong>.</span>
                                    </div>

                                    <button type="submit" class="w-full h-12 flex justify-center items-center px-4 border border-transparent rounded-2xl shadow-md text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-300 transform hover:-translate-y-0.5">
                                        Confirmar Reserva
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Mis Citas -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-3xl shadow-xl border border-stone-100 overflow-hidden h-full">
                            <div class="p-8 border-b border-stone-100 flex justify-between items-center">
                                <div>
                                    <h3 class="text-2xl font-bold text-stone-900 font-serif">Mis Citas Agendadas</h3>
                                    <p class="text-sm text-stone-500 mt-1">Historial y estado de tus próximas visitas.</p>
                                </div>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-stone-100">
                                    <thead class="bg-stone-50/50">
                                        <tr>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Tratamiento</th>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Fecha y Hora</th>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-stone-100 bg-white">
                                        @forelse($appointments as $appointment)
                                            <tr class="hover:bg-stone-50 transition-colors">
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mr-4 flex-shrink-0">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                        </div>
                                                        <div class="text-sm font-bold text-stone-900">{{ $appointment->service }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-stone-900">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</div>
                                                    <div class="text-sm text-stone-500">{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }} hrs</div>
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    <span class="px-4 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full shadow-sm
                                                        {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : '' }}
                                                        {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800 border border-green-200' : '' }}
                                                        {{ $appointment->status == 'cancelled' ? 'bg-red-100 text-red-800 border border-red-200' : '' }}
                                                    ">
                                                        {{ $appointment->status == 'pending' ? 'Pendiente' : ($appointment->status == 'confirmed' ? 'Confirmada' : 'Cancelada') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="px-8 py-16 text-center text-stone-500">
                                                    <div class="w-16 h-16 bg-stone-100 rounded-full flex items-center justify-center mx-auto mb-4 text-stone-400">
                                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    </div>
                                                    <p class="text-lg font-medium text-stone-700">Aún no tienes citas agendadas.</p>
                                                    <p class="mt-1 text-sm">Utiliza el formulario para realizar tu primera reserva.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        const bookedSlots = @json(json_decode($bookedSlotsJson, true));
        const dateInput   = document.getElementById('date');
        const timeSelect  = document.getElementById('time');

        function updateAvailableTimes() {
            if (!dateInput || !timeSelect) return;
            const selectedDate = dateInput.value;
            const takenTimes   = bookedSlots[selectedDate] || [];
            const prevValue    = timeSelect.value;

            Array.from(timeSelect.options).forEach(opt => {
                if (!opt.value) return;
                const isTaken = takenTimes.includes(opt.value);
                opt.disabled = isTaken;
                opt.textContent = isTaken
                    ? opt.value.slice(0, 5) + ' — No disponible'
                    : opt.getAttribute('data-label') || opt.textContent.replace(' — No disponible', '');
            });

            // Restore label cache
            Array.from(timeSelect.options).forEach(opt => {
                if (!opt.value) return;
                if (!opt.getAttribute('data-label')) {
                    opt.setAttribute('data-label', opt.textContent.replace(' — No disponible', ''));
                }
            });

            // Deselect if current value became unavailable
            if (takenTimes.includes(prevValue)) {
                timeSelect.value = '';
            }
        }

        if (dateInput) {
            dateInput.addEventListener('change', updateAvailableTimes);
        }

        // ── Bulk selection logic ──────────────────────────────────────────
        const selectAll   = document.getElementById('select-all');
        const bulkBar     = document.getElementById('bulk-bar');
        const selectedNum = document.getElementById('selected-num');
        const selectedCnt = document.getElementById('selected-count');

        function getChecked() {
            return Array.from(document.querySelectorAll('.row-checkbox:checked'));
        }

        function syncBulkBar() {
            const checked = getChecked();
            const count   = checked.length;

            if (count > 0) {
                bulkBar.classList.remove('hidden');
                bulkBar.classList.add('flex');
                selectedCnt.classList.remove('hidden');
                selectedNum.textContent = count;

                // Populate hidden id inputs for both forms
                ['bulk-ids-status', 'bulk-ids-delete'].forEach(containerId => {
                    const container = document.getElementById(containerId);
                    container.innerHTML = '';
                    checked.forEach(cb => {
                        const inp = document.createElement('input');
                        inp.type  = 'hidden';
                        inp.name  = 'ids[]';
                        inp.value = cb.value;
                        container.appendChild(inp);
                    });
                });
            } else {
                bulkBar.classList.add('hidden');
                bulkBar.classList.remove('flex');
                selectedCnt.classList.add('hidden');
            }

            if (selectAll) {
                const allBoxes = document.querySelectorAll('.row-checkbox');
                selectAll.checked       = count === allBoxes.length && count > 0;
                selectAll.indeterminate = count > 0 && count < allBoxes.length;
            }
        }

        function clearSelection() {
            document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = false);
            if (selectAll) { selectAll.checked = false; selectAll.indeterminate = false; }
            syncBulkBar();
        }

        if (selectAll) {
            selectAll.addEventListener('change', function () {
                document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = this.checked);
                syncBulkBar();
            });
        }

        document.querySelectorAll('.row-checkbox').forEach(cb => {
            cb.addEventListener('change', syncBulkBar);
        });
    </script>
</x-public-layout>
