export default function AdultCard({ adult, index }) {
    return (
        <section
            className={`row align-items-center g-5 mb-5 py-4 ${index % 2 !== 0 ? 'flex-md-row-reverse' : ''}`}
        >
            <div className="col-md-6">
                <img
                    src={adult.image ? `http://localhost:8000/storage/${adult.image}` : 'https://placehold.co/600x400'}
                    alt={`Adulto ${adult.name}`}
                    className="img-fluid rounded shadow-sm w-100"
                    style={{ objectFit: 'cover', maxHeight: '400px' }}
                />
            </div>

            <div className="col-md-6">
                <h2 className="fw-bold text-uppercase mb-2">{adult.name}</h2>
                <h5 className="text-muted mb-3">{adult.breed}</h5>

                <p className="text-secondary">
                    {adult.description}
                </p>

                <div className="border-top pt-3 mt-3 text-secondary">
                    <p className="mb-1 small"><strong>Titoli:</strong> {adult.titles?.map(t => t.name).join(', ') || 'Nessun titolo'}</p>
                    <p className="mb-0 small"><strong>Data di nascita:</strong> {adult.birth_date}</p>
                </div>
            </div>
        </section>
    );
}