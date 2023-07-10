import Checkbox from '@/Components/Checkbox';
import RowGuestLayout from '@/Layouts/RowGuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function EmailLogin({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('login.email'));
    };

    return (
        <RowGuestLayout>
            <Head title="Log in" />

            <div className="flex sm:flex-row flex-col w-full gap-x-12 text-sm text-gray-600">
                <p className="basis-1/2 sm:text-right sm:align-middle sm:text-lg text-center sm:mb-0 mb-8">Ek wil eintlik hier nog ander goed ook in sit. en dan is daar allerhander ander goed wat ek ook hier wil doen. maar ek is nie seker hoe die stretch werk nie.</p>
                <form className="basis-1/2 sm:align-middle" onSubmit={submit}>
                    <div>
                        <InputLabel htmlFor="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 w-full"
                            autoComplete="username"
                            isFocused={true}
                            onChange={(e) => setData('email', e.target.value)}
                        />

                        <InputError message={errors.email} className="mt-2" />
                    </div>

                    <div className="block mt-4">
                        <label className="flex items-center">
                            <Checkbox
                                name="remember"
                                checked={data.remember}
                                onChange={(e) => setData('remember', e.target.checked)}
                            />
                            <span className="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div className="flex items-center sm:justify-start justify-center mt-4">
                        <PrimaryButton disabled={processing}>
                            Verify email
                        </PrimaryButton>
                    </div>
                </form>
            </div>

        </RowGuestLayout>
    );
}
