<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head,useForm,Link } from '@inertiajs/inertia-vue3';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'


const form = useForm({
    title:'',
    completed_at:''
});

const props=  defineProps({
        todos:Array
});

function destroy(id) {
        if (confirm("Are you sure you want to Delete")) {
            form.delete(route('todos.destroy', id));
        }
    }

const submit = () => {
    form.post(route('todos.store'));
    form.title=''
    form.completed_at=''
};
const done = (id) => {
    form.post(route('todos.update'));
}

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Todo List
            </h2>
        </template>

        <div class="py-12">
          <form name="createForm" @submit.prevent="submit" >
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Todo</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class=" flex items-center">
                    <input v-model="form.title" type="text" name="title" id="title" class="focus:ring-indigo-500 focus:border-indigo-500 block w-3/6 pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Enter todo">

                   <Datepicker v-model="form.completed_at" placeholder="Enter date"  />

                   <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow ml-2">
                    Add
                    </button>
                </div>
            </div>
            </div>
            </div>
          </form>
             <table className="table-fixed w-full mt-20">
                            <thead>
                                <tr className="bg-gray-100">
                                    <th className="px-4 py-2 w-20">No.</th>
                                    <th className="px-4 py-2">Title</th>
                                    <th className="px-4 py-2">done</th>
                                    <th className="px-4 py-2">Completed at</th>
                                    <th className="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(todo ) in todos" :todo='todo' :key="todo.id" :index="index" >
                                    <td className="border px-4 py-2">{{ todo.id }}</td>
                                    <td className="border px-4 py-2">{{ todo.title }}</td>
                                    <td className="border px-4 py-2">{{ todo.completed ? 'Done' : 'Not Done' }}</td>
                                    <td className="border px-4 py-2">{{ new Date(todo.completed_at).toDateString() }}</td>
                                    <td className="border px-4 py-2">
                                        <Link
                                            tabIndex="1"
                                            className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                            :href="`/todos/${todo.id}/edit`"
                                        >
                                            Edit
                                        </Link>

                                        <button
                                            @click="destroy(todo.id)"
                                            tabIndex="-1"
                                            type="button"
                                            className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                        >
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
        </div>
    </BreezeAuthenticatedLayout>
</template>
