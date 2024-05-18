<x-app-layout>
    <script>
        const storeUrl = "{{ route('todos.store') }}";
        const updateUrl = "{{ route('todos.update', ':todoId') }}";
        const updateDoneUrl = "{{ route('todos.update.done', ':todoId') }}";
        const deleteUrl = "{{ route('todos.destroy', ':todoId') }}";

        const checkSvg = `
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 20.75H6C5.27065 20.75 4.57118 20.4603 4.05546 19.9445C3.53973 19.4288 3.25 18.7293 3.25 18V6C3.25 5.27065 3.53973 4.57118 4.05546 4.05546C4.57118 3.53973 5.27065 3.25 6 3.25H14.86C15.0589 3.25 15.2497 3.32902 15.3903 3.46967C15.531 3.61032 15.61 3.80109 15.61 4C15.61 4.19891 15.531 4.38968 15.3903 4.53033C15.2497 4.67098 15.0589 4.75 14.86 4.75H6C5.66848 4.75 5.35054 4.8817 5.11612 5.11612C4.8817 5.35054 4.75 5.66848 4.75 6V18C4.75 18.3315 4.8817 18.6495 5.11612 18.8839C5.35054 19.1183 5.66848 19.25 6 19.25H18C18.3315 19.25 18.6495 19.1183 18.8839 18.8839C19.1183 18.6495 19.25 18.3315 19.25 18V10.29C19.25 10.0911 19.329 9.90032 19.4697 9.75967C19.6103 9.61902 19.8011 9.54 20 9.54C20.1989 9.54 20.3897 9.61902 20.5303 9.75967C20.671 9.90032 20.75 10.0911 20.75 10.29V18C20.75 18.7293 20.4603 19.4288 19.9445 19.9445C19.4288 20.4603 18.7293 20.75 18 20.75Z" fill="#00FF00"/>
                <path d="M10.5 15.25C10.3071 15.2352 10.1276 15.1455 10 15L7.00001 12C6.93317 11.86 6.91136 11.7028 6.93759 11.5499C6.96382 11.3971 7.03679 11.2561 7.14646 11.1464C7.25613 11.0368 7.3971 10.9638 7.54996 10.9376C7.70282 10.9113 7.86006 10.9331 8.00001 11L10.47 13.47L19 4.99998C19.14 4.93314 19.2972 4.91133 19.4501 4.93756C19.6029 4.96379 19.7439 5.03676 19.8536 5.14643C19.9632 5.2561 20.0362 5.39707 20.0624 5.54993C20.0887 5.70279 20.0669 5.86003 20 5.99998L11 15C10.8724 15.1455 10.693 15.2352 10.5 15.25Z" fill="#00FF00"/>
            </svg>
        `;

        const editSvg = `
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.20999 20.5199C4.11375 20.521 4.01826 20.5029 3.92902 20.4669C3.83977 20.4308 3.75854 20.3775 3.68999 20.3099C3.61139 20.2323 3.55092 20.1383 3.51288 20.0346C3.47485 19.9308 3.4602 19.82 3.46999 19.7099L3.77999 15.8699C3.79328 15.6916 3.87156 15.5244 3.99999 15.3999L15.06 4.33995C15.6762 3.76286 16.4961 3.45361 17.34 3.47995C18.1784 3.48645 18.9828 3.81181 19.59 4.38995C20.1723 4.98795 20.5073 5.7839 20.5277 6.61837C20.5481 7.45284 20.2524 8.26421 19.7 8.88995L8.62999 19.9999C8.50609 20.1234 8.34386 20.201 8.16999 20.2199L4.27999 20.5699L4.20999 20.5199ZM5.20999 16.2599L4.99999 18.9999L7.73999 18.7499L18.64 7.82995C18.8525 7.57842 18.9884 7.27118 19.0314 6.94472C19.0745 6.61827 19.0229 6.28631 18.8828 5.9883C18.7428 5.69028 18.5201 5.43873 18.2413 5.26354C17.9625 5.08834 17.6393 4.99685 17.31 4.99995C17.0936 4.98621 16.8766 5.01633 16.6721 5.0885C16.4676 5.16067 16.2798 5.27341 16.12 5.41995L5.20999 16.2599Z" fill="#0000FF"/>
            </svg>
        `;

        const deleteSvg = `
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 21C10.22 21 8.47991 20.4722 6.99987 19.4832C5.51983 18.4943 4.36628 17.0887 3.68509 15.4442C3.0039 13.7996 2.82567 11.99 3.17294 10.2442C3.5202 8.49836 4.37737 6.89472 5.63604 5.63604C6.89472 4.37737 8.49836 3.5202 10.2442 3.17294C11.99 2.82567 13.7996 3.0039 15.4442 3.68509C17.0887 4.36628 18.4943 5.51983 19.4832 6.99987C20.4722 8.47991 21 10.22 21 12C21 14.387 20.0518 16.6761 18.364 18.364C16.6761 20.0518 14.387 21 12 21ZM12 4.5C10.5166 4.5 9.0666 4.93987 7.83323 5.76398C6.59986 6.58809 5.63856 7.75943 5.07091 9.12988C4.50325 10.5003 4.35473 12.0083 4.64411 13.4632C4.9335 14.918 5.64781 16.2544 6.6967 17.3033C7.7456 18.3522 9.08197 19.0665 10.5368 19.3559C11.9917 19.6453 13.4997 19.4968 14.8701 18.9291C16.2406 18.3614 17.4119 17.4001 18.236 16.1668C19.0601 14.9334 19.5 13.4834 19.5 12C19.5 10.0109 18.7098 8.10323 17.3033 6.6967C15.8968 5.29018 13.9891 4.5 12 4.5Z" fill="#FF0000"/>
                <path d="M9.00001 15.75C8.90147 15.7504 8.80383 15.7312 8.71282 15.6934C8.62181 15.6557 8.53926 15.6001 8.47001 15.53C8.32956 15.3893 8.25067 15.1987 8.25067 15C8.25067 14.8012 8.32956 14.6106 8.47001 14.47L14.47 8.46997C14.6122 8.33749 14.8002 8.26537 14.9945 8.26879C15.1888 8.27222 15.3742 8.35093 15.5116 8.48835C15.649 8.62576 15.7278 8.81115 15.7312 9.00545C15.7346 9.19975 15.6625 9.38779 15.53 9.52997L9.53001 15.53C9.46077 15.6001 9.37822 15.6557 9.2872 15.6934C9.19619 15.7312 9.09855 15.7504 9.00001 15.75Z" fill="#FF0000"/>
                <path d="M15 15.75C14.9015 15.7504 14.8038 15.7312 14.7128 15.6934C14.6218 15.6557 14.5392 15.6001 14.47 15.53L8.47 9.52997C8.33752 9.38779 8.2654 9.19975 8.26882 9.00545C8.27225 8.81115 8.35097 8.62576 8.48838 8.48835C8.62579 8.35093 8.81118 8.27222 9.00548 8.26879C9.19978 8.26537 9.38782 8.33749 9.53 8.46997L15.53 14.47C15.6704 14.6106 15.7493 14.8012 15.7493 15C15.7493 15.1987 15.6704 15.3893 15.53 15.53C15.4608 15.6001 15.3782 15.6557 15.2872 15.6934C15.1962 15.7312 15.0985 15.7504 15 15.75Z" fill="#FF0000"/>
            </svg>
        `;

        function showError(message) {
            Swal.fire({
                title: 'Error!',
                text: message,
                icon: 'error',
                confirmButtonText: 'Ok'
            })

        }

        function showSuccess(message) {
            Swal.fire({
                title: 'Success!',
                text: message,
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        }

        function init() {
            let instance = null;

            return {
                init() {
                    instance = this;
                    instance.datatable = $('#datatable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('todos.datatable') }}",
                            data: function(d) {
                                d.length = $('#datatable-entries-per-page').val();
                                d.done = $('#datatable-done').val();
                            }
                        },
                        layout: {
                            top2Start: null,
                            top2End: null,
                            topStart: null,
                            topEnd: null,
                            bottomStart: null,
                            bottomEnd: null,
                            bottom2Start: "info",
                            bottom2End: "paging"
                        },
                        columns: [{
                                data: 'id',
                                name: 'id',
                                title: 'ID',
                                className: 'text-center pr-8'
                            },
                            {
                                data: 'title',
                                name: 'title',
                                title: 'Title'
                            },
                            {
                                data: 'is_done',
                                name: 'is_done',
                                title: 'Done',
                                className: 'text-center pr-8',
                                render: function(data) {
                                    return data ? 'Yes' : 'No';
                                }
                            },
                            {
                                data: 'id',
                                name: 'action',
                                title: 'Action',
                                orderable: false,
                                searchable: false,
                                width: '100px',
                                render: function(data, type, row) {
                                    let html = `<div class="flex justify-end">`;


                                    if (row.is_done == 0)
                                        html += `<button class="text-green-600 hover:text-green-900 mr-3" x-on:click='form.done(${JSON.stringify(row)})'>
                                            ${checkSvg}
                                        </button>`

                                    html += `<button class="text-blue-600 hover:text-blue-900 mr-3" x-on:click='form.edit($dispatch, ${JSON.stringify(row)})'>
                                            ${editSvg}
                                        </button>`;

                                    html += `<button class="text-blue-600 hover:text-blue-900" x-on:click='form.delete(${JSON.stringify(row)})'>
                                            ${deleteSvg}
                                        </button>
                                    </div>`;

                                    return html;
                                }
                            }
                        ]
                    });
                },
                form: {
                    id: null,
                    title: '',
                    open: {
                        ['@click']() {
                            instance.form.id = null;
                            instance.form.title = '';
                            this.$dispatch('open-modal', 'todo');
                        }
                    },
                    save: {
                        ['@click']() {
                            if (instance.form.id) {
                                axios.put(updateUrl.replace(':todoId', instance.form.id), {
                                    title: instance.form.title
                                }).then((res) => {
                                    instance.form.id = null;
                                    instance.form.title = '';
                                    this.$dispatch('close');
                                    instance.datatable.ajax.reload();
                                    showSuccess(res.data.message);
                                }).catch((res) => {
                                    showError(res.response.data.message);
                                });
                            } else {
                                axios.post(storeUrl, {
                                    title: instance.form.title
                                }).then((res) => {
                                    instance.form.title = '';
                                    this.$dispatch('close');
                                    instance.datatable.ajax.reload();
                                    showSuccess(res.data.message)
                                }).catch((res) => {
                                    showError(res.response.data.message);
                                });
                            }
                        }
                    },
                    edit($dispatch, data) {
                        instance.form.id = data.id;
                        instance.form.title = data.title;
                        $dispatch('open-modal', 'todo');
                    },
                    done(todo) {
                        Swal.fire({
                            icon: 'warning',
                            title: `Are you sure you want to mark "${todo.title}" todo as done?`,
                            showCancelButton: true,
                            confirmButtonText: "Yes, Mark as Done",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                axios.patch(updateDoneUrl.replace(':todoId', todo.id), {
                                    is_done: 1
                                }).then((res) => {
                                    instance.datatable.ajax.reload();
                                    showSuccess(res.data.message);
                                }).catch((res) => {
                                    showError(res.response.data.message);
                                });
                            }
                        });
                    },
                    delete(todo) {
                        Swal.fire({
                            icon: 'error',
                            title: `Are you sure you want to delete "${todo.title}" todo?`,
                            showCancelButton: true,
                            confirmButtonText: "Yes, Delete",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                axios.delete(deleteUrl.replace(':todoId', todo.id)).then(() => {
                                    instance.datatable.ajax.reload();
                                }).catch((res) => {
                                    showError(res.response.data.message);
                                });
                            }
                        });
                    }
                },
                datatable: null,
                chnagePageLength(e) {
                    instance.datatable.page.len(e.target.value).draw();
                },
                chnageDone() {
                    instance.datatable.ajax.reload();
                },
                search(e) {
                    instance.datatable.search(e.target.value).draw();
                }
            }
        }
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todos') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="init()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 pb-4">
                <div class="grid grid-cols-2 px-2">
                    <div>
                        <span class="font-semibold text-l">All Todos</span>
                    </div>
                    <div class="text-right">
                        <x-primary-button x-bind="form.open">
                            {{ __('Create Todo') }}
                        </x-primary-button>
                    </div>
                </div>
                <div class="grid grid-cols-4 mt-3">
                    <div class="px-2">
                        <x-input-label for="datatable-entries-per-page" :value="__('Entries per page')" />
                        <select id="datatable-entries-per-page"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sml w-[100%] mt-2"
                            x-on:change="chnagePageLength(event)">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="px-2"></div>
                    <div class="px-2">
                        <x-input-label for="datatable-done" :value="__('Entries per page')" />
                        <select id="datatable-done"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sml w-[100%] mt-2"
                            x-on:change="chnageDone()">
                            <option value="">All</option>
                            <option value="1">Done</option>
                            <option value="0" selected>Not Done</option>
                        </select>
                    </div>
                    <div class="px-2">
                        <x-input-label for="datatable-search" :value="__('Search')" />
                        <x-text-input id="datatable-search" x-on:input.debounce.500ms="search($event)"
                            class="w-[100%] mt-2" />
                    </div>
                </div>
                <div class="pt-4">
                    <table id="datatable" class="table w-[100%]">
                    </table>
                </div>
            </div>
        </div>
        <x-modal name="todo" maxWidth="md" x-data="form">
            <div class="p-6 space-y-6">
                <h2 class="font-semibold text-l text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Create Todo') }}
                </h2>
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" name="title" type="text" x-model="form.title"
                        class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" messages="" />
                </div>
                <div class="space-x-3 text-right">
                    <x-secondary-button x-on:click="$dispatch('close')">{{ __('Close') }}</x-secondary-button>
                    <x-primary-button x-bind="form.save">{{ __('Save') }}</x-primary-button>
                </div>
            </div>
        </x-modal>
    </div>
</x-app-layout>
