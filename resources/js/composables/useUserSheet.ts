import type { User } from '@/types/user';
import { router } from '@inertiajs/vue3'; // ✅ import useRouter
import Swal from 'sweetalert2';
import { ref } from 'vue';
import { route } from 'ziggy-js';
const emptyUser: User = { id: 0, name: '', email: '', created_at: '', updated_at: '' };

export function useUserSheet() {
    const isEditUser = ref(false);
    const isSheetOpen = ref(false);
    const selectedUser = ref<User>({ ...emptyUser });
    function setUserData(user: User) {
        selectedUser.value = { ...user };
    }
    function newUserCreate() {
        setUserData(emptyUser);
        isSheetOpen.value = true;
        isEditUser.value = false;
    }
    function openEditSheet(user: User) {
        setUserData(user);
        isSheetOpen.value = true;
        isEditUser.value = true;
    }

    function cancelEdit() {
        isSheetOpen.value = false;
    }

    async function saveChanges(updatedUser: User) {
        const result = await Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to save the changes?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, save it!',
            cancelButtonText: 'Cancel',
        });

        if (!result.isConfirmed) return;

        try {
            setUserData(updatedUser);
            const userData = selectedUser.value;

            if (userData.id && userData.id > 0) {
                // Update existing user
                router.put(route('users.update', { id: userData.id }), userData);
            } else {
                // Create new user
                router.post(route('users.store'), userData);
            }

            // console.log('Response:', data);

            await Swal.fire({
                icon: 'success',
                title: 'Saved!',
                text: 'User data has been saved successfully.',
                timer: 2000,
                showConfirmButton: false,
            });

            // Close sheet & reset selectedUser
            isSheetOpen.value = false;
            selectedUser.value = { ...emptyUser };
        } catch (error) {
            console.error('Error saving user data', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to save user data.',
            });
        }
    }

    return {
        isSheetOpen,
        isEditUser,
        selectedUser,
        openEditSheet,
        newUserCreate,
        cancelEdit,
        saveChanges,
    };
}
