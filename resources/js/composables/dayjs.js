import relativeTime from 'dayjs/plugin/relativeTime';
import dayjs from 'dayjs';

export default function useDayJs() {
    dayjs.extend(relativeTime);

    function diffForHumans(datetime) {
        return dayjs(datetime).fromNow();
    }

    return {
        diffForHumans,
    };
}