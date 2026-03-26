import dayjs, { Dayjs } from 'dayjs';

type DateInput = string | Date | Dayjs | null | undefined;

export default function useDates() {
    const formatDate = (date: DateInput, format = 'DD MMM YYYY'): string => {
        if (!date) return '';
        return dayjs(date).format(format);
    };

    const formatTime = (date: DateInput, format = 'hh:mm A'): string => {
        if (!date) return '';
        return dayjs(date).format(format);
    };

    const formatDateTime = (
        date: DateInput,
        format = 'DD MMM YYYY, hh:mm A',
    ): string => {
        if (!date) return '';
        return dayjs(date).format(format);
    };

    const isValid = (date: DateInput): boolean => {
        if (!date) return false;
        return dayjs(date).isValid();
    };

    return {
        formatDate,
        formatTime,
        formatDateTime,
        isValid,
    };
}
