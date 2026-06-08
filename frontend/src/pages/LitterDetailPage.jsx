import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { useParams } from 'react-router-dom';
import axios from 'axios';

export default function LitterDetailPage() {
    const { id } = useParams();
    const [litter, setLitter] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get(`${import.meta.env.VITE_API_URL}/api/litters/${id}`)
            .then(res => {
                setLitter(res.data.data);
                setLoading(false);
            })
            .catch(err => console.error("Errore nel caricamento:", err));
    }, [id]);

    if (loading) return <div className="text-center py-5">Caricamento in corso...</div>;
    if (!litter) return <div className="text-center py-5">Cucciolata non trovata.</div>;

    return (
        <main className="bg-light py-5 mt-5">
            <div className="container">
                <div className="row g-5">
                    <div className="col-lg-6">
                        <img
                            src={litter.image ? `${import.meta.env.VITE_API_URL}/storage/${litter.image}` : 'https://placehold.co/800x600'}
                            alt={litter.title}
                            className="img-fluid rounded shadow"
                        />
                    </div>

                    <div className="col-lg-6">
                        <h1 className="fw-bold text-uppercase">{litter.title}</h1>
                        <h4 className="text-muted mb-4">{litter.father?.name} x {litter.mother?.name}</h4>
                        <p className="lead">{litter.description}</p>

                        <div className="card shadow-sm mt-4">
                            <div className="card-body">
                                <h5 className="card-title">Dettagli Accoppiamento</h5>
                                <ul className="list-group list-group-flush">
                                    <li className="list-group-item d-flex justify-content-between">
                                        <strong>Padre:</strong>
                                        {litter.father ?
                                            <Link to={`/i-nostri-cani/${litter.father?.id}`} className="mb-1 text-decoration-none text-black"> {litter.father?.name} ({litter.father?.pedigree_code})</Link>
                                            : <span>Informazioni non disponibili</span>
                                        }
                                    </li>
                                    <li className="list-group-item d-flex justify-content-between">
                                        <strong>Madre:</strong>
                                        {litter.mother ?
                                            <Link to={`/i-nostri-cani/${litter.father?.id}`} className="mb-1 text-decoration-none text-black"> {litter.mother?.name} ({litter.mother?.pedigree_code})</Link>
                                            : <span>Informazioni non disponibili</span>
                                        }
                                    </li>
                                    <li className="list-group-item d-flex justify-content-between">
                                        <strong>Stato:</strong> <span>{litter.status}</span>
                                    </li>
                                    {/* {litter.father ? ` ${litter.father.name} - ${litter.father.pedigree_code}` : ' Informazioni non disponibili'} */}
                                    <li className="list-group-item d-flex justify-content-between">
                                        <strong>Nati il:</strong> <span>{litter.birth_date ? `${litter.birth_date}` : 'In programma'}</span>
                                    </li>
                                    <li className="list-group-item d-flex justify-content-between">
                                        <strong>Cuccioli {litter.status?.toLowerCase() === 'in programma' ? 'previsti' : 'nati'}:</strong> <span>{litter.puppies?.length || 'N.D'}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="col-lg-12 mt-5">
                        <div className="card shadow-sm">
                            <div className="card-body">
                                <h3 className="card-title fw-bold">Dettaglio Cucciolata</h3>

                                {litter.puppies && litter.puppies.length > 0 ? (
                                    <div className="row mt-4">
                                        {litter.puppies.map((puppy) => (
                                            <div key={puppy.id} className="col-md-4 mb-3">
                                                <div className="p-3 border rounded">
                                                    <h5>{puppy.name || "Cucciolo senza nome"}</h5>
                                                    <p className="mb-0 text-muted">Sesso: {puppy.gender}</p>
                                                    <p className="mb-0 text-muted">Colore: {puppy.coat_color}</p>
                                                    <p className="mb-0 text-muted"> Coda: {puppy.tail_type || 'Non indicata'}</p>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                ) : (
                                    <p className="text-muted mt-3">Nessun cucciolo registrato per questa cucciolata.</p>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    );
}
