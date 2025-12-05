export default async function getFilteredTasks(
  {
    showDescription,
    showCategory,
    showPriority,
    showDate,
    showStatus,
    selectedCategory,
    selectedPriority,
    selectedDueDateLt,
    selectedDueDateGt,
    selectedStatus,
  } = {}
) {
    const fields = ['title'];
    if(showDescription) fields.push("description");
    if(showCategory) fields.push("category_id");
    if(showPriority) fields.push("priority_id");
    if(showDate) fields.push("due_date");
    if(showStatus) fields.push("is_completed");

    const filters = [];
    if(selectedCategory) {
        filters.push(`category_id:eq=${selectedCategory}`);
    }
    if(selectedPriority) {
        filters.push(`priority_id:eq=${selectedPriority}`);
    }
    if(selectedDueDateGt) {
        filters.push(`due_date:gt=${selectedDueDateGt}`);
    }
    if(selectedDueDateLt) {
        filters.push(`due_date:lt=${selectedDueDateLt}`);
    }
    if(selectedStatus !== undefined && selectedStatus !== '') {
        filters.push(`is_completed:eq=${selectedStatus}`);
    }

    let url = `/api/v2/getFilteredTasks?pola=${fields.join(",")}`;
    if(filters.length > 0) {
        url += "&" + filters.join("&");
    }

    try {
        const response = await fetch(url, {
            method: 'GET',
            credentials: 'include',
            headers: {
                'Accept': 'application/json'
            }
        });
        const result = await response.json();
        console.log('wynik zapytania', result);
        if(result.success) {
            return result.tasks;
        }

        return [];
    }catch(error) {
        console.log("Bład pobierania tasków: ", error);
        return [];
    }
}