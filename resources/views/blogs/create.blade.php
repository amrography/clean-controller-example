<x-dashboard-app-full>
    <x-dashboard::container>
        <x-dashboard::card>
            <x-slot name="header">
                Create a new blog
            </x-slot>

            <x-dashboard::form :action="route('blogs.store')">
                <x-dashboard::form.input type="text"
                    name="title">
                    Blog title
                </x-dashboard::form.input>

                <x-dashboard::form.input type="text"
                    name="slug">
                    Blog slug
                </x-dashboard::form.input>

                <div style="width: 200px">
                    <x-dashboard::form.image name="image">
                        Choose an image
                    </x-dashboard::form.image>
                </div>

                <x-dashboard::form.textarea name="body">
                    Placeholder text
                </x-dashboard::form.textarea>

                <x-dashboard::button type="submit">
                    @lang('Create')
                </x-dashboard::button>
            </x-dashboard::form>
        </x-dashboard::card>
    </x-dashboard::container>
</x-dashboard-app-full>
