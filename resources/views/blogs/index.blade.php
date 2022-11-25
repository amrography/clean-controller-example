<x-dashboard-app-full>
    <x-dashboard::container>
        <x-dashboard::card.table title="Blogs list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>
                            <img src="{{ $blog->image_url }}"
                                alt="{{ $blog->title }}"
                                width="50">
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            <x-dashboard::form :action="route('blogs.destroy', $blog->id)"
                                method="delete">
                                <x-dashboard::button type="submit"
                                    color="danger">
                                    @lang('Delete')
                                </x-dashboard::button>
                            </x-dashboard::form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-dashboard::card.table>
    </x-dashboard::container>
</x-dashboard-app-full>
