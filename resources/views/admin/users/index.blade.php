@extends('admin.layouts.app')

@section('page_title', 'إدارة المستخدمين والصلاحيات')

@section('content')

    <div class="space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-white">إدارة المستخدمين وصلاحيات لوحة التحكم</h2>
                <p class="text-xs text-slate-400">إنشاء وتعديل حسابات المدراء والمشرفين المخولين بإدارة الموقع والطلبات</p>
            </div>
            
            <button type="button" onclick="document.getElementById('create-user-modal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs transition-colors shadow-lg shadow-amber-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                <span>إضافة مستخدم جديد</span>
            </button>
        </div>

        <!-- Users Table -->
        <div class="rounded-3xl bg-slate-900 border border-slate-800 overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs">
                    <thead class="bg-slate-950/60 text-slate-400 font-bold border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">المستخدم</th>
                            <th class="px-6 py-4">البريد الإلكتروني</th>
                            <th class="px-6 py-4">الجوال</th>
                            <th class="px-6 py-4">مستوى الصلاحية</th>
                            <th class="px-6 py-4">الحالة</th>
                            <th class="px-6 py-4">تاريخ الإنشاء</th>
                            <th class="px-6 py-4 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach($users as $user)
                            <tr class="hover:bg-slate-800/40 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-amber-400">
                                            {{ mb_substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-white flex items-center gap-2">
                                                <span>{{ $user->name }}</span>
                                                @if($user->id === auth()->id())
                                                    <span class="text-[10px] px-2 py-0.5 rounded bg-amber-500/10 text-amber-400 border border-amber-500/20 font-bold">حسابك الحالي</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono text-slate-300" dir="ltr">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono text-slate-400" dir="ltr">
                                    {{ $user->phone ?? '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->role === 'admin')
                                        <x-badge variant="purple">مدير النظام الكامل (Admin)</x-badge>
                                    @else
                                        <x-badge variant="blue">مشرف فرع (Manager)</x-badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-badge :variant="$user->is_active ? 'emerald' : 'red'">
                                        {{ $user->is_active ? 'نشط' : 'معطل' }}
                                    </x-badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-400 font-mono">
                                    {{ $user->created_at->format('Y-m-d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2 space-x-reverse">
                                    <!-- Edit Trigger Button -->
                                    <button type="button" onclick="openEditModal({{ json_encode($user) }})" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white transition-colors" title="تعديل">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>

                                    <!-- Delete Button -->
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" data-confirm-title="حذف المستخدم والصلاحيات" data-item-name="{{ $user->name }} ({{ $user->email }})" data-confirm-message="هل أنت متأكد من رغبتك في حذف حساب هذا المستخدم نهائياً؟ لن يتمكن من تسجيل الدخول للوحة التحكم مجدداً.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete p-2 rounded-lg transition-all" title="حذف المستخدم">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-slate-800">
                {{ $users->links() }}
            </div>
        </div>

    </div>

    <!-- Create User Modal -->
    <div id="create-user-modal" class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-6">
            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                <h3 class="text-lg font-bold text-white">إضافة مستخدم جديد</h3>
                <button type="button" onclick="document.getElementById('create-user-modal').classList.add('hidden')" class="text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">الاسم الكامل <span class="text-amber-400">*</span></label>
                    <input type="text" name="name" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="مثال: خالد المنصور">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">البريد الإلكتروني <span class="text-amber-400">*</span></label>
                    <input type="email" name="email" required dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="user@keyshop.com">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">رقم الجوال (اختياري)</label>
                    <input type="text" name="phone" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="05XXXXXXXX">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">مستوى الصلاحية <span class="text-amber-400">*</span></label>
                    <select name="role" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                        <option value="manager">مشرف فرع (Manager - إدارة الطلبات والخدمات والمعرض)</option>
                        <option value="admin">مدير نظام كامل (Admin - إدارة كافة الصلاحيات والمستخدمين)</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">كلمة المرور المؤقتة <span class="text-amber-400">*</span></label>
                    <input type="password" name="password" required minlength="8" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="••••••••" dir="ltr">
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_active" id="create_active" value="1" checked class="rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-400">
                    <label for="create_active" class="text-xs font-bold text-slate-300 cursor-pointer">حساب نشط ومفعل فوراً</label>
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-800">
                    <button type="button" onclick="document.getElementById('create-user-modal').classList.add('hidden')" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs">إلغاء</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs shadow-lg shadow-amber-500/20">إنشاء المستخدم</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="edit-user-modal" class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-6">
            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                <h3 class="text-lg font-bold text-white">تعديل بيانات المستخدم</h3>
                <button type="button" onclick="document.getElementById('edit-user-modal').classList.add('hidden')" class="text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form id="edit-user-form" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">الاسم الكامل <span class="text-amber-400">*</span></label>
                    <input type="text" id="edit_name" name="name" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">البريد الإلكتروني <span class="text-amber-400">*</span></label>
                    <input type="email" id="edit_email" name="email" required dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">رقم الجوال</label>
                    <input type="text" id="edit_phone" name="phone" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">مستوى الصلاحية <span class="text-amber-400">*</span></label>
                    <select id="edit_role" name="role" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                        <option value="manager">مشرف فرع (Manager)</option>
                        <option value="admin">مدير نظام كامل (Admin)</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">تغيير كلمة المرور (اتركه فارغاً إذا كنت لا تريد تغييره)</label>
                    <input type="password" name="password" minlength="8" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="••••••••" dir="ltr">
                </div>

                <div class="flex items-center gap-2 pt-2" id="edit_active_container">
                    <input type="checkbox" name="is_active" id="edit_active" value="1" class="rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-400">
                    <label for="edit_active" class="text-xs font-bold text-slate-300 cursor-pointer">حساب نشط</label>
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-800">
                    <button type="button" onclick="document.getElementById('edit-user-modal').classList.add('hidden')" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs">إلغاء</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs shadow-lg shadow-amber-500/20">تحديث المستخدم</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(user) {
            const form = document.getElementById('edit-user-form');
            form.action = `/admin/users/${user.id}`;
            document.getElementById('edit_name').value = user.name;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('edit_phone').value = user.phone || '';
            document.getElementById('edit_role').value = user.role;
            document.getElementById('edit_active').checked = !!user.is_active;

            document.getElementById('edit-user-modal').classList.remove('hidden');
        }
    </script>

@endsection
