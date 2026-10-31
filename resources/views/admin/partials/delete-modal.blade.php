<!-- ======================================================== -->
<!-- 🗑️ GLOBAL CONFIRM DELETE MODAL COMPONENT (SHARED ACROSS APP) -->
<!-- ======================================================== -->

<!-- Modal Backdrop -->
<div id="delete-modal-backdrop" 
     class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 transition-opacity duration-200 opacity-0 pointer-events-none" 
     onclick="closeDeleteModal()">
</div>

<!-- Modal Dialog Box -->
<div id="delete-modal" 
     class="fixed inset-0 z-50 flex items-center justify-center p-4 transition-all duration-200 opacity-0 pointer-events-none scale-95" 
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="delete-modal-title">
     
    <div id="delete-modal-dialog" 
         class="relative w-full max-w-md rounded-3xl bg-slate-900 border border-slate-800 p-6 sm:p-7 shadow-2xl text-center overflow-hidden transition-colors">
         
        <!-- Top Close (X) Button -->
        <button type="button" 
                onclick="closeDeleteModal()" 
                class="absolute top-4 left-4 p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/80 transition-colors cursor-pointer" 
                aria-label="إلغاء وإغلاق">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Danger Glowing Icon -->
        <div class="mx-auto w-16 h-16 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-500 flex items-center justify-center mb-4 shadow-lg shadow-red-500/10">
            <svg class="w-8 h-8 animate-pulse text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>

        <!-- Title -->
        <h3 id="delete-modal-title" class="text-base sm:text-lg font-black text-white mb-2">
            تأكيد الحذف النهائي
        </h3>

        <!-- Optional Item Badge / Name -->
        <div id="delete-modal-item-wrapper" class="hidden mb-3">
            <span id="delete-modal-item" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-800/90 border border-slate-700/60 text-xs font-bold text-amber-400 max-w-full truncate">
                <svg class="w-3.5 h-3.5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                <span id="delete-modal-item-text" class="truncate"></span>
            </span>
        </div>

        <!-- Message Body -->
        <p id="delete-modal-message" class="text-xs text-slate-400 leading-relaxed mb-6 px-2">
            هل أنت متأكد من رغبتك في حذف هذا العنصر؟ لن يمكنك التراجع عن هذا الإجراء بعد تنفيذه.
        </p>

        <!-- Actions -->
        <div class="flex items-center gap-3">
            <!-- Confirm Delete Button -->
            <button type="button" 
                    id="delete-modal-confirm-btn" 
                    onclick="submitDeleteModalForm()" 
                    class="flex-1 py-3 px-4 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white font-black text-xs transition-all shadow-lg shadow-red-500/25 flex items-center justify-center gap-2 cursor-pointer group">
                <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span id="delete-modal-confirm-text">نعم، حذف نهائياً</span>
            </button>

            <!-- Cancel Button -->
            <button type="button" 
                    onclick="closeDeleteModal()" 
                    class="flex-1 py-3 px-4 rounded-xl bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white font-bold text-xs transition-colors border border-slate-700/80 cursor-pointer">
                إلغاء التراجع
            </button>
        </div>
    </div>
</div>

<script>
    (function() {
        let activeDeleteForm = null;

        window.openDeleteModal = function(options) {
            let config = {};
            if (options instanceof HTMLFormElement) {
                config.form = options;
                config.title = options.dataset.confirmTitle || 'تأكيد الحذف النهائي';
                config.message = options.dataset.confirmMessage || 'هل أنت متأكد من رغبتك في حذف هذا العنصر؟ لا يمكن التراجع عن هذا الإجراء.';
                config.itemName = options.dataset.itemName || '';
                config.confirmText = options.dataset.confirmText || 'نعم، حذف نهائياً';
            } else if (typeof options === 'object') {
                config = options;
            }

            activeDeleteForm = config.form || null;

            const titleEl = document.getElementById('delete-modal-title');
            const messageEl = document.getElementById('delete-modal-message');
            const itemWrapper = document.getElementById('delete-modal-item-wrapper');
            const itemText = document.getElementById('delete-modal-item-text');
            const confirmText = document.getElementById('delete-modal-confirm-text');

            if (titleEl) titleEl.textContent = config.title || 'تأكيد الحذف النهائي';
            if (messageEl) messageEl.textContent = config.message || 'هل أنت متأكد من رغبتك في حذف هذا العنصر؟ لا يمكن التراجع عن هذا الإجراء.';
            if (confirmText) confirmText.textContent = config.confirmText || 'نعم، حذف نهائياً';

            if (itemWrapper && itemText) {
                if (config.itemName && config.itemName.trim() !== '') {
                    itemText.textContent = config.itemName;
                    itemWrapper.classList.remove('hidden');
                } else {
                    itemWrapper.classList.add('hidden');
                }
            }

            const backdrop = document.getElementById('delete-modal-backdrop');
            const modal = document.getElementById('delete-modal');

            if (backdrop && modal) {
                backdrop.classList.remove('opacity-0', 'pointer-events-none');
                backdrop.classList.add('opacity-100', 'pointer-events-auto');

                modal.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
                modal.classList.add('opacity-100', 'pointer-events-auto', 'scale-100');

                document.body.classList.add('overflow-hidden');
            }
        };

        window.closeDeleteModal = function() {
            const backdrop = document.getElementById('delete-modal-backdrop');
            const modal = document.getElementById('delete-modal');

            if (backdrop && modal) {
                backdrop.classList.remove('opacity-100', 'pointer-events-auto');
                backdrop.classList.add('opacity-0', 'pointer-events-none');

                modal.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
                modal.classList.add('opacity-0', 'pointer-events-none', 'scale-95');

                document.body.classList.remove('overflow-hidden');
            }
            activeDeleteForm = null;
        };

        window.submitDeleteModalForm = function() {
            if (!activeDeleteForm) return;

            const confirmBtn = document.getElementById('delete-modal-confirm-btn');
            if (confirmBtn) {
                confirmBtn.disabled = true;
                confirmBtn.classList.add('opacity-70', 'cursor-not-allowed');
                confirmBtn.innerHTML = `
                    <svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>جاري الحذف...</span>
                `;
            }

            activeDeleteForm.dataset.bypassConfirm = 'true';
            activeDeleteForm.submit();
        };

        // Universal Interception: All DELETE forms or forms marked with .confirm-delete-form
        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (!form || form.dataset.bypassConfirm === 'true') return;

            const isDelete = form.classList.contains('confirm-delete-form') || 
                             form.hasAttribute('data-confirm-delete') || 
                             form.querySelector('input[name="_method"][value="DELETE"]') !== null;

            if (isDelete) {
                e.preventDefault();
                openDeleteModal(form);
            }
        });

        // Close on Escape key press
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('delete-modal');
                if (modal && !modal.classList.contains('pointer-events-none')) {
                    closeDeleteModal();
                }
            }
        });
    })();
</script>
