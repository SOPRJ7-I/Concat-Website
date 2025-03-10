<x-Layout>
</x-Layout>

<style>

  .form-container {
    max-width: 32rem;
    margin-left: auto;
    margin-right: auto;
    background-color:#e4e2ff;
    padding: 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.form-title {
    display:flex;
    justify-content:center;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.form-label {
    /* display:flex;
    justify-content:center; */
    display: block;
    margin-bottom: 0.5rem;
}

.form-input {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.25rem; 
    margin-bottom: 1rem;
}

.form-button {
    background-color: #3b82f6;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    border: none;
    cursor: pointer;
}

.form-button:hover {
    background-color: #2563eb;
}

</style>

<form class="form-container" method="POST" action="/ReadCommunityNight">
  
  @csrf
    <h2 class="form-title">Create a Community Night</h2>
    
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-input" required>
    
    <label class="form-label">Image (optional)</label>
    <input type="file" name="image" class="form-input">
    
    <label class="form-label">Description</label>
    <textarea name="description" class="form-input"></textarea>
    
    <label class="form-label">Start Time</label>
    <input type="datetime-local" name="start_time" class="form-input" required>
    
    <label class="form-label">End Time</label>
    <input type="datetime-local" name="end_time" class="form-input">
    
    <label class="form-label">Location</label>
    <input type="text" name="location" class="form-input">
    
    <label class="form-label">Event Link</label>
    <input type="url" name="link" class="form-input">
    
    <label class="form-label">Capacity</label>
    <input type="number" name="capacity" class="form-input">
    
    <button type="submit" class="form-button">Create</button>
</form>