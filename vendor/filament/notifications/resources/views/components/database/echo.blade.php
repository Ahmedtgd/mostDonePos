@props([
    'channel',
])

<div
    x-data="{}"
    x-init="
        window.addEventListener('EchoLoaded', () => {
            window.Echo.private(@js($channel)).listen('.database-notifications.sent', () => {
                setTimeout(() => $wire.call('$refresh'), 500)
            })
        })
    "
    {{ $attributes }}
></div>
